<div class="bbw-form-group">
	<label for="publish_mode">Publish status <span class="text-danger">*</span></label>
	<select name="publish_mode" id="publish_mode" class="form-control" required style="max-width: 320px;">
		<option value="active" {{ old('publish_mode', $publish_mode ?? 'active') === 'active' ? 'selected' : '' }}>Active (Publish Now)</option>
		<option value="scheduled" {{ old('publish_mode', $publish_mode ?? '') === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
		<option value="inactive" {{ old('publish_mode', $publish_mode ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
	</select>
	@error('publish_mode')
	<span class="bbw-field-error">{{ $message }}</span>
	@enderror
</div>
<div class="bbw-form-group" id="published_at_group" style="{{ old('publish_mode', $publish_mode ?? 'active') === 'scheduled' ? '' : 'display:none;' }}">
	<label for="published_at">Publish on <span class="text-danger">*</span></label>
	<input
		type="datetime-local"
		class="form-control"
		id="published_at"
		name="published_at"
		style="max-width: 320px;"
		value="{{ old('published_at', isset($model) && $model->published_at ? $model->published_at->format('Y-m-d\TH:i') : '') }}"
		min="{{ now()->format('Y-m-d\TH:i') }}"
	>
	<p class="help-block" style="margin:0.35rem 0 0;font-size:12px;color:#5f6f68;">Blog will appear on the website at this date and time.</p>
	@error('published_at')
	<span class="bbw-field-error">{{ $message }}</span>
	@enderror
</div>
