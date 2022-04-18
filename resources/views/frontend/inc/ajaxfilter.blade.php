@forelse ($courses as $course)
<div class="cat-course-item">
	<x-horizontal-courses :course="$course"></x-horizontal-courses>
</div>
@empty
<div class="col-md-12 text-center">
	<x-nodata></x-nodata>
</div>
@endforelse
