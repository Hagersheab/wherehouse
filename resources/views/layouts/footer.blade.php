<footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-auto">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Wherehouse') }}. {{ __('All rights reserved.') }}</p>
            <div class="flex gap-4">
                <a href="{{ route('dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-300">{{ __('Dashboard') }}</a>
                <a href="{{ route('categories.index') }}" class="hover:text-gray-700 dark:hover:text-gray-300">{{ __('Categories') }}</a>
                <a href="{{ route('items.index') }}" class="hover:text-gray-700 dark:hover:text-gray-300">{{ __('Items') }}</a>
                <a href="{{ route('warehouse.index') }}" class="hover:text-gray-700 dark:hover:text-gray-300">{{ __('Warehouse') }}</a>
                <a href="{{ route('imports.index') }}" class="hover:text-gray-700 dark:hover:text-gray-300">{{ __('Imports') }}</a>
                <a href="{{ route('exports.index') }}" class="hover:text-gray-700 dark:hover:text-gray-300">{{ __('Exports') }}</a>
            </div>
        </div>
    </div>
</footer>
