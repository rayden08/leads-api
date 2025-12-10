<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;  
use App\Http\Requests\LeadRequest;
use App\Http\Requests\UpdateLeadStatusRequest;
use App\Http\Requests\UpdateLeadInfoRequest;
use Illuminate\Http\Request;

class LeadController extends Controller
{

    
    /**
     * Display a listing of leads.
     */
    public function index(Request $request)
    {
        $query = Lead::with(['customer', 'product', 'user']);
        
        // Filter berdasarkan role
        if (!$request->user()->isAdmin()) {
            $query->where('user_id', $request->user()->id);
        }
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhereHas('customer', function($q2) use ($search) {
                      $q2->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter by status jika ada
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $leads = $query->orderBy('created_at', 'desc')
                      ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $leads->map(function($lead) {
                return [
                    'id' => $lead->id,
                    'name' => $lead->name,
                    'customer_name' => $lead->customer->name ?? 'N/A',
                    'phone' => $lead->customer->phoneNumbers->first()->number ?? null,
                    'status' => $this->statusToString($lead->status),
                    'status_label' => $this->getStatusLabel($lead->status),
                    'created_by' => $lead->user->name ?? 'Unknown',
                    'created_at' => $lead->created_at->format('Y-m-d H:i:s'),
                ];
            }),
            'meta' => [
                'total' => $leads->total(),
                'current_page' => $leads->currentPage(),
                'last_page' => $leads->lastPage(),
                'per_page' => $leads->perPage(),
            ]
        ]);
    }

    /**
     * Store a newly created lead.
     */
    public function store(LeadRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        
        $lead = Lead::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Lead created successfully',
            'data' => $lead->load(['customer', 'product', 'user'])
        ], 201);
    }

    /**
     * Display the specified lead.
     */
    public function show($id)
    {
        try {
            $lead = Lead::with([
                'customer.addresses.province',
                'customer.addresses.city', 
                'customer.addresses.district',
                'customer.addresses.village',
                'customer.phoneNumbers',
                'product',
                'user'
            ])->findOrFail($id);
            
            // Check ownership (non-admin can only view own leads)
            $user = request()->user();
            if (!$user->isAdmin() && $lead->user_id !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only view your own leads'
                ], 403);
            }
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $lead->id,
                    'name' => $lead->name,
                    'description' => $lead->description,
                    'status' => $this->statusToString($lead->status),
                    'status_label' => $this->getStatusLabel($lead->status),
                    'created_at' => $lead->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $lead->updated_at->format('Y-m-d H:i:s'),
                    'customer' => $lead->customer ? [
                        'id' => $lead->customer->id,
                        'name' => $lead->customer->name,
                        'email' => $lead->customer->email,
                        'address' => $lead->customer->address,
                        'addresses' => $lead->customer->addresses->map(function($address) {
                            return [
                                'province_code' => $address->province_code,
                                'province_name' => $address->province->name ?? null,
                                'city_code' => $address->city_code,
                                'city_name' => $address->city->name ?? null,
                                'district_code' => $address->district_code,
                                'district_name' => $address->district->name ?? null,
                                'village_code' => $address->village_code,
                                'village_name' => $address->village->name ?? null,
                                'postal_code' => $address->postal_code,
                                'full_address' => $address->full_address,
                            ];
                        }),
                        'phone_numbers' => $lead->customer->phoneNumbers->map(function($phone) {
                            return [
                                'number' => $phone->number,
                                'type' => $phone->type
                            ];
                        })
                    ] : null,
                    'product' => $lead->product ? [
                        'id' => $lead->product->id,
                        'code' => $lead->product->code,
                        'name' => $lead->product->name,
                        'price' => $lead->product->price,
                        'description' => $lead->product->description
                    ] : null,
                    'created_by' => $lead->user ? [
                        'id' => $lead->user->id,
                        'name' => $lead->user->name,
                        'email' => $lead->user->email,
                        'role' => $lead->user->role
                    ] : null
                ]
            ]);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lead not found'
            ], 404);
        }
    }

    /**
     * Update the specified lead.
     */
   public function update(LeadRequest $request, $id)
    {
        // Cari lead (termasuk yang sudah di-soft delete)
        $lead = Lead::withTrashed()->find($id);
        
       
        if (!$lead) {
            return response()->json([
                'success' => false,
                'message' => 'Lead not found'
            ], 404);
        }
        
        // Jika lead sudah di-soft delete
        if ($lead->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'Lead has been deleted'
            ], 410);
        }
        
     
        if ($lead->status === 'converted') {
            return response()->json([
                'success' => false,
                'message' => 'Cannot update converted lead'
            ], 403);
        }
        
        $user = $request->user();
        if (!$user->isAdmin() && $lead->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'You can only update your own leads'
            ], 403);
        }
        
        $lead->update($request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Lead updated successfully',
            'data' => $lead->load(['customer', 'product', 'user'])
        ]);
    }

    /**
     * Remove the specified lead.
     */
        public function destroy(Request $request, $id)
    {
        
        $lead = Lead::withTrashed()->find($id);
        
        
        if (!$lead) {
            return response()->json([
                'success' => true,
                'message' => 'Lead not found'
            ], 200);
        }
        
        // Jika lead sudah di-soft delete
        if ($lead->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'Lead was already deleted'
            ], 410);
        }
        
        // Authorization check
        $user = $request->user();
        if (!$user->isAdmin() && $lead->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'You can only delete your own leads'
            ], 403);
        }
        
        // Soft delete (gunakan delete() bukan forceDelete())
        $lead->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Lead deleted successfully'
        ]);
    }

    /**
     * Update lead status.
     */
    public function updateStatus(UpdateLeadStatusRequest $request, $id)
    {
        try {
            $lead = Lead::findOrFail($id);
            
            // Check converted status
            if ($lead->status === 'converted') {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot update status of converted lead'
                ], 403);
            }
            
            // Check ownership
            $user = $request->user();
            if (!$user->isAdmin() && $lead->user_id !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only update your own leads'
                ], 403);
            }
            
            $lead->update(['status' => $request->status]);
            
            return response()->json([
                'success' => true,
                'message' => 'Lead status updated successfully',
                'data' => $lead
            ]);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lead not found'
            ], 404);
        }
    }

    /**
     * Update lead information.
     */
    public function updateInfo(UpdateLeadInfoRequest $request, $id)
    {
        try {
            $lead = Lead::findOrFail($id);
            
            // Check converted status
            if ($lead->status === 'converted') {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot update converted lead'
                ], 403);
            }
            
            // Check ownership
            $user = $request->user();
            if (!$user->isAdmin() && $lead->user_id !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only update your own leads'
                ], 403);
            }
            
            $lead->update($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Lead information updated successfully',
                'data' => $lead->load(['customer', 'product', 'user'])
            ]);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lead not found'
            ], 404);
        }
    }

    /**
     * Helper method to get status label.
     */
    private function getStatusLabel($status)
    {
        $status = $this->statusToString($status);
        
        $labels = [
            'new' => 'New',
            'contacted' => 'Contacted',
            'unqualified' => 'Unqualified',
            'in_progress' => 'In Progress',
            'converted' => 'Converted',
            'closed' => 'Closed'
        ];
        
        return $labels[$status] ?? ucfirst($status);
    }

    /**
     * Convert status to string (handles enum, object, or string).
     */
    private function statusToString($status)
    {
        if ($status instanceof \BackedEnum) {
            return $status->value;
        }
        
        if (is_object($status) && method_exists($status, 'value')) {
            return $status->value;
        }
        
        if (is_null($status)) {
            return 'unknown';
        }
        
        return (string) $status;
    }
}