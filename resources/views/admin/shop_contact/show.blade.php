@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@push('css')
<style>
	.shop-contact-detail-card {
		background: #ffffff;
		border-radius: 12px;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
		border: 2px solid #e0e0e0;
		overflow: hidden;
	}
	.shop-contact-detail-header {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		color: #1a1a1a;
		padding: 18px 30px;
		border-radius: 12px 12px 0 0;
		border-bottom: 3px solid #242424;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
		text-align: center;
	}
	.shop-contact-detail-header h1 { margin: 0; font-size: 22px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
	.shop-contact-detail-body {
		padding: 30px 40px;
		background: #f8f9fa;
	}
	.shop-contact-detail-table {
		background: #fff;
		border-radius: 8px;
		border: 2px solid #e0e0e0;
		overflow: hidden;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
	}
	.shop-contact-detail-table table { margin: 0; }
	.shop-contact-detail-table th {
		width: 180px;
		background: rgba(238, 183, 45, 0.12);
		color: #2c3e50;
		font-weight: 600;
		font-size: 14px;
		padding: 14px 16px;
		border: 1px solid #e0e0e0;
	}
	.shop-contact-detail-table td {
		padding: 14px 16px;
		font-size: 14px;
		color: #2c3e50;
		border: 1px solid #e0e0e0;
	}
	.shop-contact-detail-table tr:hover td { background: rgba(238, 183, 45, 0.04); }
	.btn-view-all {
		background: linear-gradient(180deg, #EEB72D 0%, #FFE59F 49.52%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		border: 1px solid #242424;
		padding: 10px 24px;
		border-radius: 8px;
		font-weight: 600;
		text-decoration: none !important;
		display: inline-block;
		transition: all 0.3s ease;
		margin-bottom: 20px;
	}
	.btn-view-all:hover {
		background: linear-gradient(135deg, #d4a020 0%, #EEB72D 100%) !important;
		color: #1a1a1a !important;
		box-shadow: 0 2px 8px rgba(238,183,45,0.4);
		transform: translateY(-1px);
	}
</style>
@endpush

<section class="content-header" style="margin-bottom: 0;">
	<div class="shop-contact-detail-card">
		<div class="shop-contact-detail-header">
			<h1>{{ $page_title }}</h1>
		</div>
		<div class="shop-contact-detail-body">
			<div class="d-flex justify-content-end mb-3">
				<a href="{{ route('shopcontact.index') }}" class="btn-view-all"><i class="fa fa-list"></i> View All</a>
			</div>
			<div class="shop-contact-detail-table">
				<table class="table table-bordered mb-0">
					<tr>
						<th>Name</th>
						<td>{{ $model->name }}</td>
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
