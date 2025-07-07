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
                        <a href="{{ route('admin.users.index') }}">
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow hover:bg-indigo-700 text-sm">
                                Users Index
                            </button>
                        </a>
                    </div>
                  <div>User Name:{{$user->name}}</div>
                  <div>User Email:{{$user->email}}</div>
                                      <!-- عرض صلاحيات الدور -->
                    <div class="mt-6 p-2">
                        <h2 class="text-2xl font-semibold">Role Permissions</h2>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-4 p-2">
                        @if ($user->roles)
                            @foreach ($user->roles as $user_role)
                                <form method="POST"
                                    action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}"
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
                         action="{{ route('admin.users.roles', $user->id) }}"
                            class="bg-gray-100 p-4 rounded-md shadow-md">
                            @csrf
                            <div class="sm:col-span-6">
                                <label for="permission" class="block text-sm font-medium text-gray-900">Roles</label>
                                <div class="mt-2">
                                    <select id="permission" name="permission"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @foreach ($roles as $role)
                                            @if (!$role->permissions->contains('id', $permission->id))
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
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
                    <!-- عرض صلاحيات الدور -->
                    <div class="mt-6 p-2">
                        <h2 class="text-2xl font-semibold">Permissions</h2>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-4 p-2">
                        @if ($user->permissions)
                            @foreach ($user->permissions as $user_permission)
                                <form method="POST"
                                    action="{{ route('admin.users.permissions.revoke', [$role->id, $role_permission->id]) }}"
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
                         action="{{ route('admin.users.permissions', $user->id) }}"
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
    </div>
</x-admin-layout>
