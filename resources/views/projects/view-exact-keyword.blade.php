<div class="project-url">
@if(!empty($projectExactKeywordData[0]))
   @foreach($projectExactKeywordData as $projectExactKeyword)
     <span class='badge badge-info mb-3'  style="font-size:14px;">{{ $projectExactKeyword->exact_keywords }}</span><br>
	@endforeach
@else
	<p class="text-center">Exact Keyword Not Found</p>
@endif
</div>