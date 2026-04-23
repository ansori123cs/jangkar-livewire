  <!-- Sidebar -->
  <aside
      class="fixed z-40 inset-y-0 left-0 w-64 bg-blue-500 rounded-br-2xl text-white shadow-lg transform md:translate-x-0 transition-transform duration-200"
      :class="open ? 'translate-x-0' : '-translate-x-full'">
      <div class="p-4">
          <h1 class="text-xl font-bold">Admin Panel</h1>
      </div>

      <nav class="mt-4">
          @foreach ($menus as $menu)
              <a href="{{ $menu['route'] }}" class="block px-4 py-2 hover:bg-blue-00">
                  {{ $menu['name'] }}
              </a>
          @endforeach


      </nav>
  </aside>
