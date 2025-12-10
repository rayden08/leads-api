<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Lead;
use Symfony\Component\HttpFoundation\Response;

class CheckConvertedStatus
{
    public function handle(Request $request, Closure $next): Response
    {
       
        $leadId = $request->route('id') ?? $request->route('lead');
        
        if ($leadId) {
            // Cari termasuk yang sudah di-soft delete
            $lead = Lead::withTrashed()->find($leadId);
            
            // Jika lead tidak ditemukan sama sekali, lanjutkan
            if (!$lead) {
                return $next($request);
            }
            
            // Jika lead sudah di-soft delete, lanjutkan (biarkan controller handle)
            if ($lead->trashed()) {
                return $next($request);
            }
            
            // Cek jika lead sudah converted
            if ($lead->status === 'converted') {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot modify converted lead'
                ], 403);
            }
        }

        return $next($request);
    }
}