<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $allRoles = Role::all();
        return view('users.index', compact('users','allRoles'));
    }
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'nullable|string',
            'company' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'role' => 'required|string|exists:roles,name',
        ]);
    
        $user->update($validated);
        $user->syncRoles([$validated['role']]); // Ensure only one role assigned
    
        return redirect()->back()->with('success', 'User updated successfully.');
    }
    

    public function destroy($id)
{
    try {
        $user = User::findOrFail($id); 
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        
    } catch (ModelNotFoundException $e) {
        // Log the error and notify the user
        Log::error("User with ID {$id} not found: " . $e->getMessage());

        return redirect()->route('users.index')->with('error', 'User not found.');
        
    } catch (QueryException $e) {
        // Handle query-related issues (e.g., foreign key constraint violation)
        Log::error("Error deleting user with ID {$id}: " . $e->getMessage());

        return redirect()->route('users.index')->with('error', 'Error deleting user. Please try again.');
    } catch (\Exception $e) {
        // Catch any other general exception
        Log::error("Unexpected error deleting user with ID {$id}: " . $e->getMessage());

        return redirect()->route('users.index')->with('error', 'Unexpected error occurred.');
    }
    
}
}