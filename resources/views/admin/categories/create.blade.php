<div class="card">
    <div class="card-header">
        <h4>{{__('Add New Category')}}</h4>
    </div>
    <form action="{{ route('categories.store') }}" method="POST"  enctype="multipart/form-data">

        @csrf
        <div class="card-body">
            <div class="row ">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required
                            maxlength="50" value="{{ old('name') }}">
                    </div>
                    @error('name')
                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                    @enderror
                </div>

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Name_Ua') }}</label>
                        <input type="text" name="name_ua" class="form-control @error('name_ua') is-invalid @enderror" required
                            maxlength="50" value="{{ old('name_ua') }}">
                    </div>
                    @error('name_ua')
                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                    @enderror
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Slug') }}</label>
                        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" required
                            maxlength="50" value="{{ old('slug') }}">
                    </div>
                    @error('slug')
                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                    @enderror
                </div>
				
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Image') }}</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" required
                            maxlength="50" value="{{ old('image') }}">
                    </div>
                    @error('image')
                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                    @enderror
                </div>

                <div class="col-12 col-md-12 col-lg-12 ">
                    <div class="form-group">
                        <label>{{ __('Status') }}</label>
                        <select name="status" class="form-control select2-dd @error('status') is-invalid @enderror"
                            required>
                            <option value="0">{{__('De-Active')}}</option>
                            <option value="1">{{__('Active')}}</option>

                        </select>
                    </div>
                    @error('status')
                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                    @enderror
                </div>

            </div>

        </div>

        <div class="card-footer text-right">
            <button class="btn btn-primary" type="submit">{{__('Submit')}}</button>
        </div>
    </form>
</div>