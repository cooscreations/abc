<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inspection extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'inspections';

    public static $searchable = [
        'afa_order_number',
        'public_notes',
    ];

    protected $dates = [
        'inspection_planned_date',
        'actual_start_date',
        'crd_inspection_complete_date',
        'qc_report_received',
        'qe_audit_complete_date',
        'qc_report_sent_to_customer_date',
        'fabric_received_date',
        'qc_paid_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'order_id',
        'afa_order_number',
        'inspector_name_id',
        'customer_id',
        'customer_order_number',
        'order_follower_id',
        'supplier_id',
        'order_item_id',
        'qc_status_id',
        'qty_inspected',
        'inspection_passed',
        'inspection_planned_date',
        'actual_start_date',
        'crd_inspection_complete_date',
        'total_days_inspection_open',
        'total_days_on_site',
        'qc_report_received',
        'qe_audit_complete_date',
        'qc_report_sent_to_customer_date',
        'sharepoint_photos_url',
        'fabric_received_date',
        'inspector_private_notes',
        'public_notes',
        'qc_paid_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function inspector_name()
    {
        return $this->belongsTo(AfaStaff::class, 'inspector_name_id');
    }

    public function customer()
    {
        return $this->belongsTo(ContactCompany::class, 'customer_id');
    }

    public function order_follower()
    {
        return $this->belongsTo(AfaStaff::class, 'order_follower_id');
    }

    public function supplier()
    {
        return $this->belongsTo(ContactCompany::class, 'supplier_id');
    }

    public function order_item()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }

    public function qc_status()
    {
        return $this->belongsTo(InspectionStatus::class, 'qc_status_id');
    }

    public function getInspectionPlannedDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setInspectionPlannedDateAttribute($value)
    {
        $this->attributes['inspection_planned_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getActualStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setActualStartDateAttribute($value)
    {
        $this->attributes['actual_start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCrdInspectionCompleteDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCrdInspectionCompleteDateAttribute($value)
    {
        $this->attributes['crd_inspection_complete_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function additional_q_cs()
    {
        return $this->belongsToMany(AfaStaff::class);
    }

    public function getQcReportReceivedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setQcReportReceivedAttribute($value)
    {
        $this->attributes['qc_report_received'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getQeAuditCompleteDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setQeAuditCompleteDateAttribute($value)
    {
        $this->attributes['qe_audit_complete_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getQcReportSentToCustomerDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setQcReportSentToCustomerDateAttribute($value)
    {
        $this->attributes['qc_report_sent_to_customer_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getFabricReceivedDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFabricReceivedDateAttribute($value)
    {
        $this->attributes['fabric_received_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getQcPaidDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setQcPaidDateAttribute($value)
    {
        $this->attributes['qc_paid_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
