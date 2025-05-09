<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $allRoles = Role::all();
        return view('users.index', compact('users', 'allRoles'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
            'role' => 'required|exists:roles,name',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'firstname' => $validated['firstname'],
                'lastname' => $validated['lastname'],
                'fullname' => $validated['firstname'] . ' ' . $validated['lastname'],
                'password' => Hash::make($validated['password']),
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'company' => $validated['company'],
                'status' => $validated['status'],
            ]);

            $user->syncRoles([$validated['role']]);

            DB::commit();

            return redirect()->back()->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('User creation failed: ' . $e->getMessage());

            return redirect()->back()->withErrors('User creation failed. Please try again.');
        }
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

        DB::beginTransaction();

        try {
            // Update user fields
            $user->firstname = $validated['firstname'];
            $user->lastname = $validated['lastname'];
            $user->email = $validated['email'];
            $user->phone_number = $validated['phone_number'];
            $user->company = $validated['company'];
            $user->status = $validated['status'];

            $user->save();

            // Sync user roles
            $user->syncRoles([$validated['role']]);

            DB::commit();

            return redirect()->back()->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('User update failed: ', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Failed to update user. Please try again.');
        }
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
