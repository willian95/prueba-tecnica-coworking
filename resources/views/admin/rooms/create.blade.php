<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear sala
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div>
                    <div class="container w-100">
                        
                        <form action="{{ route('admin.rooms.store') }}">
                            @csrf
                            <div class="mb-3">
                                <x-input-label for="title" :value="'Titulo'" />
                                
                                <x-text-input id="title" class="block mt-1 w-full"
                                                type="text"
                                                name="title"
                                                :value="old('title')"
                                                />
                                
                                @foreach($errors->get('title') as $message)
                                    <p class="error fs-6 text-danger">{{__($message)}}</p>
                                @endforeach

                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción</label>
                                <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
                                @foreach($errors->get('description') as $message)
                                    <p class="error fs-6 text-danger">{{__($message)}}</p>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>

                    </div>
                </div>
            </div>

            
        </div>
    </div>

</x-app-layout>
