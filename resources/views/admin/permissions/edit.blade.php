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
      <button class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow hover:bg-indigo-700 text-sm"><a href="{{route('admin.permissions.index')}}">Permission Index</a></button>
    </div>
   <div class="flex flex-col">
   <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
  <form method="POST" action="{{route('admin.permissions.update',$permission)}}">
    @csrf
    @method('PUT')
    <div class="sm:col-span-6">
      <label for="name" class="block text-sm font-medium text-gray-700"> Post Title </label>
      <div class="mt-1">
        <input type="text"
         id="name"
         name="name"
          class="block w-full  appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
        value="{{$permission->name}}" />
      </div>
      @error('name') <span class="text-red-400 text-sm">{{$message}}</span>  @enderror
    </div>
    <div class="sm:col-span-6 pt-5">
     <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Update</button>
    </div>
  </form>
</div>
   </div>
    </div>
    </div>
   </div>
    </div>
</x-admin-layout>
