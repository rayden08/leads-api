<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Lead;
use Symfony\Component\HttpFoundation\Response;

class CheckLeadOwnership
{
    public function handle(Request $request, Closure $next, string $permission): Response
{
    $user = $request->user();
    
   
    if ($user->role === 'admin') {
        return $next($request);
    }

   
    $leadId = $request->route('lead') ?? $request->route('id');
    
    if ($leadId) {
        
        $lead = Lead::withTrashed()->find($leadId);
        
       
        if (!$lead) {
            return $next($request);
        }
        
      
        if ($lead->trashed()) {
            return $next($request);
        }
        
        switch ($permission) {
            case 'view':
                if ($lead->user_id !== $user->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'You can only view your own leads'
                    ], 403);
                }
                break;
                
            case 'update':
                if ($lead->user_id !== $user->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'You can only update your own leads'
                    ], 403);
                }
                break;
                
            case 'delete':
                if ($lead->user_id !== $user->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'You can only delete your own leads'
                    ], 403);
                }
                break;
        }
    }

    return $next($request);
}
}