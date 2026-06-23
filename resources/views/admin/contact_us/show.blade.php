@extends('layouts.admin.app')
@section('title', 'Contact Us Details')
@section('content')
@push('css')
<style>
	/* Balanced Body IV Wellness — teal / sage / cream */
	.contact-detail-card {
		background: #ffffff;
		border-radius: 16px;
		box-shadow: 0 8px 24px rgba(45, 106, 98, 0.1);
		border: 1px solid rgba(45, 106, 98, 0.15);
		overflow: hidden;
	}
	.contact-detail-header {
		background: linear-gradient(135deg, #1a3f3c 0%, #2d6a62 38%, #3d9a8e 72%, #4a9a8e 100%) !important;
		color: #fff;
		padding: 18px 30px;
		border-radius: 16px 16px 0 0;
		border-bottom: 1px solid rgba(255, 255, 255, 0.2);
		box-shadow: 0 4px 16px rgba(45, 106, 98, 0.25);
		text-align: center;
	}
	.contact-detail-header h1 {
		margin: 0;
		font-size: 22px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		color: #fff;
		text-shadow: 0 1px 2px rgba(0, 0, 0, 0.12);
	}
	.contact-detail-body {
		padding: 30px 40px;
		background: #eef2f0;
	}
	.contact-detail-table {
		background: #fff;
		border-radius: 12px;
		border: 1px solid rgba(45, 106, 98, 0.12);
		overflow: hidden;
		box-shadow: 0 2px 8px rgba(45, 106, 98, 0.06);
	}
	.contact-detail-table table { margin: 0; }
	.contact-detail-table th {
		width: 180px;
		background: linear-gradient(135deg, rgba(238, 246, 244, 0.95), rgba(245, 250, 249, 0.98));
		color: #1d2b33;
		font-weight: 600;
		font-size: 14px;
		padding: 14px 16px;
		border: 1px solid rgba(45, 106, 98, 0.12);
	}
	.contact-detail-table td {
		padding: 14px 16px;
		font-size: 14px;
		color: #374151;
		border: 1px solid rgba(45, 106, 98, 0.1);
	}
	.contact-detail-table tr:hover td { background: rgba(45, 106, 98, 0.05); }
	.btn-view-all {
		background: linear-gradient(135deg, #2d6a62 0%, #4a9a8e 100%) !important;
		color: #fff !important;
		border: none;
		padding: 10px 24px;
		border-radius: 9999px;
		font-weight: 600;
		text-decoration: none !important;
		display: inline-block;
		transition: background 0.2s ease, box-shadow 0.2s ease, transform 0.15s ease;
		margin-bottom: 20px;
		box-shadow: 0 4px 14px rgba(45, 106, 98, 0.35);
	}
	.btn-view-all:hover {
		background: linear-gradient(135deg, #1a5c54 0%, #3d9a8e 100%) !important;
		color: #fff !important;
		box-shadow: 0 6px 20px rgba(45, 106, 98, 0.4);
		transform: translateY(-1px);
	}
</style>
@endpush

<section class="content-header" style="margin-bottom: 0;">
	<div class="contact-detail-card">
		<div class="contact-detail-header">
			<h1>Contact Us Details</h1>
		</div>
		<div class="contact-detail-body">
			<div class="d-flex justify-content-end mb-3">
				<a href="{{ route('contactus.index') }}" class="btn-view-all"><i class="fa fa-list"></i> View All</a>
			</div>
			<div class="contact-detail-table">
				<table class="table table-bordered mb-0">
					<tr>
						<th>Name</th>
						<td>{{ $model->first_name }} {{ $model->last_name }}</td>
					</tr>
					<tr>
						<th>Email</th>
						<td>{{ $model->email }}</td>
					</tr>
					<tr>
						<th>Phone</th>
						<td>{{ $model->phone }}</td>
					</tr>
					<tr>
						<th>Service of Interest</th>
						<td>{{ $model->service_of_interest ?: '—' }}</td>
					</tr>
					<tr>
						<th>Preferred Date</th>
						<td>{{ $model->preferred_date ? $model->preferred_date->format('F j, Y') : '—' }}</td>
					</tr>
					<tr>
						<th>Message</th>
						<td>{!! nl2br(e($model->message)) !!}</td>
					</tr>
					<tr>
						<th>Date</th>
						<td>{{ $model->created_at ? \Carbon\Carbon::parse($model->created_at)->format('d F Y, h:i A') : '—' }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</section>
@endsection
