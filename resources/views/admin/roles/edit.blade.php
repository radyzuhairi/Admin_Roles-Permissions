<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-7xl mx-auto bg-white shadow rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Users</h2>
                            <p class="text-sm text-gray-500">
                                A list of all the users in your account including their name, title, email and role.
                            </p>
                        </div>
                        <a href="{{ route('admin.roles.index') }}">
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow hover:bg-indigo-700 text-sm">
                                Role Index Page
                            </button>
                        </a>
                    </div>

                    <!-- تحديث اسم الدور -->
                    <div class="flex flex-col">
                        <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                            <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="sm:col-span-6">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Role name</label>
                                    <div class="mt-1">
                                        <input type="text" id="name" name="name" value="{{ $role->name }}"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('name')
                                        <span class="text-red-400 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="sm:col-span-6 pt-5">
                                    <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- عرض صلاحيات الدور -->
                    <div class="mt-6 p-2">
                        <h2 class="text-2xl font-semibold">Role Permissions</h2>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-4 p-2">
                        @if ($role->permissions)
                            @foreach ($role->permissions as $role_permission)
                                <form method="POST"
                                    action="{{ route('admin.roles.permissions.revoke', [$role->id, $role_permission->id]) }}"
                                    onsubmit="return confirm('Are you sure?');"
                                    class="flex items-center space-x-2 px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">{{ $role_permission->name }}</button>
                                </form>
                            @endforeach
                        @endif
                    </div>

                    <!-- إسناد صلاحية جديدة -->
                    <div class="max-w-xl mt-6">
                        <form method="POST"
                         action="{{ route('admin.roles.permissions', $role->id) }}"
                            class="bg-gray-100 p-4 rounded-md shadow-md">
                            @csrf
                            <div class="sm:col-span-6">
                                <label for="permission" class="block text-sm font-medium text-gray-900">Assign Permission</label>
                                <div class="mt-2">
                                    <select id="permission" name="permission"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @foreach ($permissions as $permission)
                                            @if (!$role->permissions->contains('id', $permission->id))
                                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('permission')
                                        <span class="text-red-400 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <button type="submit"
                                    class="px-4 py-2 bg-green-500 hover:bg-green-700 text-white rounded-md">
                                    Assign
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
