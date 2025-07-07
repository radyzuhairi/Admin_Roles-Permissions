<x-admin-layout>

    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
  <div class="max-w-7xl mx-auto bg-white shadow rounded-lg p-6">
    <div class="flex items-center justify-between mb-4">
      <div>
        <h2 class="text-xl font-semibold text-gray-900">Users</h2>
        <p class="text-sm text-gray-500">A list of all the users in your account including their name, title, email and role.</p>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50 text-left text-sm font-semibold text-gray-700">
          <tr>
            <th class="py-3 px-6">Name</th>
            <th class="py-3 px-6">Email</th>
           <!-- <th class="py-3 px-6">Role</th> -->
            <th class="py-3 px-6"></th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
            @foreach ($users as $user )

          <!-- Row -->
          <tr>
            <td class="py-4 px-6 flex items-center gap-4">
                <div class="flex items-center">
               {{$user->name}}
              </div>
            </td>
            <td class="py-4 px-6 flex items-center gap-4">
                <div class="flex items-center">
               {{$user->email}}
              </div>
            </td>
            <td>
                <div class="flex justify-end">
                   <div class=" flex space-x-2">
                    <a href="{{route('admin.users.show',$user->id)}}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md">Roles</a>
                   <form method="POST" class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md"  action="{{route('admin.users.destroy' , $user->id)}}" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                   </form>
                </div>
                </div>
            </td>
          </tr>
           @endforeach
          <!-- Add more rows as needed -->
        </tbody>
      </table>
    </div>
  </div>
            </div>
        </div>
    </div>
</x-admin-layout>
