@push('css')
<style>
	.bbw-crud-theme {
		--bbw-teal: #2d6a62;
		--bbw-teal-deep: #1a3f3c;
		--bbw-sage: #4a9a8e;
		--bbw-mint: #3d9a8e;
		--bbw-cream: #eef2f0;
		--bbw-text: #1d2b33;
	}
	.bbw-crud-card {
		background: #fff;
		border-radius: 16px;
		box-shadow: 0 8px 24px rgba(45, 106, 98, 0.1);
		border: 1px solid rgba(45, 106, 98, 0.15);
		overflow: hidden;
		margin-bottom: 24px;
	}
	.bbw-crud-header {
		background: linear-gradient(135deg, var(--bbw-teal-deep) 0%, var(--bbw-teal) 38%, var(--bbw-mint) 72%, var(--bbw-sage) 100%) !important;
		color: #fff;
		padding: 18px 30px;
		border-radius: 16px 16px 0 0;
		border-bottom: 2px solid rgba(26, 63, 60, 0.35);
		box-shadow: 0 4px 16px rgba(45, 106, 98, 0.22);
		text-align: center;
		position: relative;
	}
	.bbw-crud-header h1 {
		margin: 0;
		font-size: 22px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		color: #fff !important;
		text-shadow: 0 1px 2px rgba(0, 0, 0, 0.12);
		padding-right: 0;
	}
	.bbw-crud-header .bbw-crud-add {
		position: absolute;
		right: 20px;
		top: 50%;
		transform: translateY(-50%);
		background: #fff;
		color: var(--bbw-teal-deep) !important;
		border: 2px solid rgba(255, 255, 255, 0.95);
		padding: 8px 18px;
		border-radius: 9999px;
		font-size: 13px;
		font-weight: 700;
		text-decoration: none !important;
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.12);
		transition: all 0.2s ease;
		white-space: nowrap;
	}
	.bbw-crud-header .bbw-crud-add:hover {
		background: var(--bbw-text);
		color: #fff !important;
		border-color: var(--bbw-text);
		transform: translateY(-50%) translateY(-2px);
		box-shadow: 0 4px 14px rgba(29, 43, 51, 0.22);
	}
	.bbw-crud-toolbar {
		background: #fafaf8;
		padding: 18px 24px;
		border-bottom: 1px solid rgba(45, 106, 98, 0.1);
		display: flex;
		flex-wrap: wrap;
		gap: 12px;
		align-items: center;
	}
	.bbw-crud-toolbar .form-control {
		border: 1px solid rgba(45, 106, 98, 0.2);
		border-radius: 10px;
		font-size: 14px;
		min-width: 200px;
		max-width: 320px;
		transition: border-color 0.2s ease, box-shadow 0.2s ease;
	}
	.bbw-crud-toolbar .form-control:focus {
		border-color: var(--bbw-teal);
		box-shadow: 0 0 0 3px rgba(45, 106, 98, 0.15);
		outline: none;
	}
	.bbw-crud-toolbar select.form-control {
		max-width: 220px;
	}
	.bbw-crud-body {
		padding: 20px 24px 28px;
		background: var(--bbw-cream);
	}
	.bbw-crud-table-wrap {
		background: #fff;
		border-radius: 12px;
		border: 1px solid rgba(45, 106, 98, 0.12);
		overflow: hidden;
		box-shadow: 0 2px 8px rgba(45, 106, 98, 0.06);
	}
	table.bbw-crud-table {
		margin: 0;
	}
	table.bbw-crud-table thead tr {
		background: linear-gradient(135deg, #eef6f4 0%, #f5faf9 100%) !important;
		border-bottom: 1px solid rgba(45, 106, 98, 0.2);
	}
	table.bbw-crud-table thead th {
		font-weight: 600;
		color: var(--bbw-text);
		font-size: 12px;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		padding: 14px 12px;
		border: none;
		vertical-align: middle;
	}
	table.bbw-crud-table tbody td {
		padding: 12px;
		vertical-align: middle;
		font-size: 14px;
		color: #374151;
		border-color: rgba(45, 106, 98, 0.1);
	}
	table.bbw-crud-table tbody tr { transition: background 0.2s ease; }
	table.bbw-crud-table tbody tr:hover { background: rgba(45, 106, 98, 0.05); }
	.bbw-action-cell {
		display: inline-flex;
		flex-wrap: nowrap;
		flex-direction: row;
		gap: 6px;
		align-items: center;
		justify-content: flex-start;
		white-space: nowrap;
		min-width: 0;
	}
	table.bbw-crud-table tbody td.bbw-action-td {
		white-space: nowrap;
		width: 1%;
	}
	.bbw-btn-view {
		background: linear-gradient(135deg, #f8fcfb 0%, #eef6f4 100%) !important;
		border: 1.5px solid rgba(45, 106, 98, 0.5) !important;
		color: var(--bbw-teal-deep) !important;
		font-weight: 600;
		padding: 5px 11px !important;
		border-radius: 9999px !important;
		font-size: 12px;
		line-height: 1.2;
		text-decoration: none !important;
		display: inline-flex;
		align-items: center;
		gap: 5px;
		flex-shrink: 0;
		box-shadow: 0 1px 4px rgba(45, 106, 98, 0.12);
		transition: all 0.2s ease;
	}
	.bbw-btn-view:hover,
	.bbw-btn-view:focus {
		background: linear-gradient(135deg, var(--bbw-teal-deep) 0%, var(--bbw-teal) 100%) !important;
		border-color: var(--bbw-teal-deep) !important;
		color: #fff !important;
		transform: translateY(-1px);
		box-shadow: 0 3px 10px rgba(45, 106, 98, 0.3);
	}
	.bbw-btn-view .fa {
		font-size: 13px;
	}
	.bbw-btn-edit {
		background: linear-gradient(135deg, var(--bbw-teal) 0%, var(--bbw-sage) 100%) !important;
		border: none !important;
		color: #fff !important;
		font-weight: 600;
		padding: 5px 11px !important;
		border-radius: 9999px !important;
		font-size: 12px;
		line-height: 1.2;
		text-decoration: none !important;
		display: inline-flex;
		align-items: center;
		gap: 5px;
		flex-shrink: 0;
		box-shadow: 0 2px 8px rgba(45, 106, 98, 0.28);
		transition: all 0.2s ease;
	}
	.bbw-btn-edit:hover {
		background: linear-gradient(135deg, #1a5c54 0%, var(--bbw-mint) 100%) !important;
		color: #fff !important;
		transform: translateY(-1px);
		box-shadow: 0 4px 12px rgba(45, 106, 98, 0.35);
	}
	table.bbw-crud-table .bbw-btn-delete,
	table.bbw-crud-table .btn-danger.bbw-btn-delete {
		border-radius: 9999px !important;
		font-weight: 600;
		font-size: 12px;
		line-height: 1.2;
		padding: 5px 11px !important;
		display: inline-flex !important;
		align-items: center;
		gap: 5px;
		flex-shrink: 0;
		transition: transform 0.2s ease, box-shadow 0.2s ease;
	}
	table.bbw-crud-table .bbw-btn-delete:hover {
		transform: translateY(-1px);
		box-shadow: 0 2px 8px rgba(220, 38, 38, 0.35);
	}
	.bbw-badge-on {
		display: inline-block;
		background: #15803d;
		color: #fff;
		padding: 4px 10px;
		border-radius: 9999px;
		font-size: 11px;
		font-weight: 600;
	}
	.bbw-badge-off {
		display: inline-block;
		background: #b91c1c;
		color: #fff;
		padding: 4px 10px;
		border-radius: 9999px;
		font-size: 11px;
		font-weight: 600;
	}
	.bbw-callout {
		background: #ecfdf5;
		border: 1px solid #6ee7b7;
		border-radius: 10px;
		padding: 12px 16px;
		color: #14532d;
		font-weight: 500;
		margin-bottom: 18px;
	}
	.bbw-pagination-row td {
		background: #fafaf8 !important;
		border-top: 1px solid rgba(45, 106, 98, 0.12) !important;
		padding: 16px !important;
	}
	/* Form screens */
	.bbw-form-card {
		background: #fff;
		border-radius: 16px;
		box-shadow: 0 8px 24px rgba(45, 106, 98, 0.1);
		border: 1px solid rgba(45, 106, 98, 0.15);
		overflow: hidden;
		margin-bottom: 24px;
	}
	.bbw-form-header {
		background: linear-gradient(135deg, var(--bbw-teal-deep) 0%, var(--bbw-teal) 38%, var(--bbw-mint) 72%, var(--bbw-sage) 100%) !important;
		color: #fff;
		padding: 16px 24px;
		display: flex;
		align-items: center;
		justify-content: space-between;
		flex-wrap: wrap;
		gap: 12px;
		border-bottom: 2px solid rgba(26, 63, 60, 0.35);
	}
	.bbw-form-header h1 {
		margin: 0;
		font-size: 20px;
		font-weight: 700;
		color: #fff;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}
	.bbw-form-back {
		background: #fff;
		color: var(--bbw-teal-deep) !important;
		border: 2px solid rgba(255, 255, 255, 0.95);
		padding: 8px 18px;
		border-radius: 9999px;
		font-size: 13px;
		font-weight: 700;
		text-decoration: none !important;
		transition: all 0.2s ease;
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
	}
	.bbw-form-back:hover {
		background: var(--bbw-text);
		color: #fff !important;
		border-color: var(--bbw-text);
	}
	.bbw-form-body {
		padding: 28px 28px 32px;
		background: var(--bbw-cream);
	}
	.bbw-form-inner {
		background: #fff;
		border-radius: 12px;
		border: 1px solid rgba(45, 106, 98, 0.12);
		padding: 24px 28px;
		box-shadow: 0 2px 8px rgba(45, 106, 98, 0.06);
	}
	.bbw-form-group {
		margin-bottom: 22px;
	}
	.bbw-form-group label,
	.bbw-form-group .control-label {
		font-weight: 600;
		color: var(--bbw-text);
		font-size: 14px;
		margin-bottom: 8px;
		display: block;
	}
	.bbw-form-group .form-control,
	.bbw-form-inner .form-control {
		border: 2px solid #e5e7eb;
		border-radius: 10px;
		font-size: 14px;
		transition: border-color 0.2s ease, box-shadow 0.2s ease;
	}
	.bbw-form-group .form-control:focus,
	.bbw-form-inner .form-control:focus {
		border-color: var(--bbw-teal);
		box-shadow: 0 0 0 3px rgba(45, 106, 98, 0.15);
		outline: none;
	}
	.bbw-field-error {
		color: #b91c1c;
		font-size: 13px;
		margin-top: 6px;
		display: block;
	}
	.bbw-form-actions {
		margin-top: 8px;
		padding-top: 20px;
		border-top: 1px solid rgba(45, 106, 98, 0.1);
		display: flex;
		gap: 12px;
		flex-wrap: wrap;
		align-items: center;
	}
	.bbw-btn-submit {
		background: linear-gradient(135deg, var(--bbw-teal) 0%, var(--bbw-sage) 100%) !important;
		border: none !important;
		color: #fff !important;
		font-weight: 600;
		padding: 12px 28px !important;
		border-radius: 9999px !important;
		font-size: 15px;
		box-shadow: 0 4px 14px rgba(45, 106, 98, 0.32);
		transition: all 0.2s ease;
	}
	.bbw-btn-submit:hover {
		background: linear-gradient(135deg, #1a5c54 0%, var(--bbw-mint) 100%) !important;
		color: #fff !important;
		transform: translateY(-1px);
		box-shadow: 0 6px 18px rgba(45, 106, 98, 0.38);
	}
	.bbw-repeater__head {
		margin-bottom: 10px;
	}
	.bbw-repeater__label {
		margin: 0 !important;
		display: block;
	}
	.bbw-repeater__foot {
		margin-top: 12px;
		padding-top: 4px;
	}
	.bbw-repeater__foot .bbw-repeater__add {
		width: 100%;
		padding: 10px 16px;
	}
	.bbw-repeater__add {
		background: linear-gradient(135deg, var(--bbw-teal) 0%, var(--bbw-sage) 100%);
		color: #fff;
		border: none;
		border-radius: 9999px;
		padding: 6px 14px;
		font-size: 13px;
		font-weight: 600;
		cursor: pointer;
		transition: transform 0.15s ease, box-shadow 0.2s ease;
		box-shadow: 0 2px 8px rgba(45, 106, 98, 0.25);
	}
	.bbw-repeater__add:hover {
		transform: translateY(-1px);
		box-shadow: 0 4px 12px rgba(45, 106, 98, 0.32);
	}
	.bbw-repeater__list {
		display: flex;
		flex-direction: column;
		gap: 10px;
	}
	.bbw-repeater__row {
		display: flex;
		align-items: center;
		gap: 8px;
	}
	.bbw-repeater--textarea .bbw-repeater__row {
		align-items: flex-start;
	}
	.bbw-repeater--textarea .bbw-repeater__remove {
		margin-top: 6px;
	}
	.bbw-repeater__row .bbw-repeater__input {
		flex: 1;
		min-width: 0;
	}
	.bbw-repeater--textarea .bbw-repeater__input {
		resize: vertical;
		min-height: 88px;
	}
	.bbw-repeater__remove {
		flex-shrink: 0;
		width: 38px;
		height: 38px;
		padding: 0;
		border: 1px solid rgba(185, 28, 28, 0.35);
		border-radius: 10px;
		background: #fff;
		color: #b91c1c;
		cursor: pointer;
		transition: background 0.2s ease, border-color 0.2s ease;
	}
	.bbw-repeater__remove:hover {
		background: #fef2f2;
		border-color: #b91c1c;
	}
	.bbw-form-card .image-preview-section {
		margin-top: 12px;
		padding: 14px;
		background: #fafaf8;
		border: 1px dashed rgba(45, 106, 98, 0.28);
		border-radius: 12px;
		text-align: center;
	}
	.bbw-form-card .image-preview-section img.bbw-image-preview {
		display: block;
		max-width: 100%;
		max-height: 240px;
		width: auto;
		height: auto;
		margin: 0 auto;
		object-fit: contain;
		border-radius: 8px;
		background: #fff;
	}
	.bbw-form-card .image-preview-section img.bbw-image-preview.is-placeholder {
		opacity: 0.65;
		max-height: 140px;
	}
	.bbw-form-card .image-preview-hint {
		margin: 10px 0 0;
		font-size: 12px;
		color: #5f6f68;
	}
	@media (max-width: 768px) {
		.bbw-crud-header .bbw-crud-add {
			position: static;
			transform: none;
			margin-top: 12px;
			display: inline-flex;
		}
		.bbw-crud-header { padding-bottom: 16px; }
		.bbw-crud-toolbar .form-control { max-width: 100%; min-width: 0; width: 100%; }
		.bbw-crud-toolbar select.form-control { max-width: 100%; }
	}
</style>
@endpush
