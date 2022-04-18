<div class="card">
    <div class="card-header">
        <h4>{{__('Edit Category')}}</h4>
    </div>
    <form action="{{ route('categories.update', [$category->id]) }}" method="POST"  enctype="multipart/form-data" >

        @csrf
        @method("PUT")
        <div class="card-body">
            <div class="row ">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required
                            maxlength="50" value="{{ old('name',$category->name) }}">
                    </div>
                    @error('name')
                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                    @enderror
                </div>

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Name_Ua') }}</label>
                        <input type="text" name="name_ua" class="form-control @error('name_ua') is-invalid @enderror" required
                            maxlength="50" value="{{ old('name_ua',$category->name_ua) }}">
                    </div>
                    @error('name_ua')
                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                    @enderror
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Slug') }}</label>
                        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" required
                            maxlength="50" value="{{ old('slug',$category->slug) }}">
                    </div>
                    @error('slug')
                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                    @enderror
                </div>
				
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Image') }}</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" >
						@if(old('image',$category->image)) <img src="/{{ old('image',$category->image) }}" height=100 /> @endif
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
                            <option value="0" {{$category->status == 0 ? 'selected' : ''}}>{{__('De-Active')}}</option>
                            <option value="1" {{$category->status == 1 ? 'selected' : ''}}>{{__('Active')}}</option>

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