<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Joshuahales\UserApiPackage\UserApiService;
use Joshuahales\UserApiPackage\Exceptions\UserNotFoundException;
use Joshuahales\UserApiPackage\Exceptions\ApiConnectionException;
use Joshuahales\UserApiPackage\Exceptions\InvalidUserDataException;

class UserApiController extends Controller
{
    /**
     * Handle the request to get user data from the API.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserById($id = 1)
    {
        // Instantiate the User API Service
        $service = new UserApiService();

        try {
            // Fetch the user by ID (or default to 1 if no ID is provided in the URL)
            $user = $service->getUserById($id);
            // Return the user data as a JSON response
            return response()->json($user->toArray(), 200);
        } catch (UserNotFoundException $e) {
            // If the user is not found, return a 404 error with a message
            return response()->json(['error' => 'User not found: ' . $e->getMessage()], 404);
        } catch (ApiConnectionException $e) {
            // If there is an API connection issue, return a 500 error with a message
            return response()->json(['error' => 'API Connection Error: ' . $e->getMessage()], 500);
        } catch (InvalidUserDataException $e) {
            // If the API returns invalid data, return a 422 error with a message
            return response()->json(['error' => 'Invalid User Data: ' . $e->getMessage()], 422);
        } catch (\Exception $e) {
            // Catch any other general exceptions and return a 500 error
            return response()->json(['error' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
        }
    }

     /**
     * Handle the request to get paginated users from the API.
     *
     * @param int $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPaginatedUsers($page = 1)
    {
        // Instantiate the User API Service
        $service = new UserApiService();

        try {
            // Fetch paginated users based on the page number
            $users = $service->getPaginatedUsers($page);
            // Return the user data as a JSON response
            return response()->json($users, 200);
        } catch (ApiConnectionException $e) {
            // Handle API connection failures
            return response()->json(['error' => 'API Connection Error: ' . $e->getMessage()], 500);
        } catch (InvalidUserDataException $e) {
            // Handle invalid user data from the API
            return response()->json(['error' => 'Invalid User Data: ' . $e->getMessage()], 422);
        } catch (\Exception $e) {
            // Handle general exceptions
            return response()->json(['error' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the form to create a new user.
     *
     * @return \Illuminate\View\View
     */
    public function showCreateUserForm()
    {
        return view('create-user');
    }

    /**
     * Handle the request to create a new user via the API.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUser(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'job' => 'required|string|max:255',
        ]);

        // Instantiate the User API Service
        $service = new UserApiService();

        try {
            // Call the createUser method with the validated data
            $user = $service->createUser($validated['first_name'], $validated['last_name'], $validated['job']);

            // Redirect back to the form with a success message
            return redirect()->back()->with('success', 'User created successfully! User ID: ' . $user->toArray()['id']);
        } catch (ApiConnectionException $e) {
            // Handle API connection errors and redirect with error message
            return redirect()->back()->with('error', 'API Connection Error: ' . $e->getMessage());
        } catch (InvalidUserDataException $e) {
            // Handle invalid user data errors and redirect with error message
            return redirect()->back()->with('error', 'Invalid User Data: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Catch any other general exceptions and redirect with error message
            return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }
}