<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    protected $table = 'exports';

    protected $fillable = [
        'order_id','export_code', 'warehouse_export_code', 'quantity', 'sub_total','ship_total','gift_fee', 'total', 'discount', 'status', 'note','supplier_id', 'agencies','address','phone', 'warehouse_id', 'created_user_id', 'updated_user_id'
    ];

    public function suppliers()
    {
        return $this->belongsTo('App\Supplier','supplier_id');
    }

    public function getSupplierAttribute()
    {
        return $this->suppliers->first();
    }

    public function warehouses()
    {
        return $this->belongsTo('App\Warehouse', 'warehouse_id');
    }

    public function getWarehouseAttribute()
    {
        return $this->warehouses->first();
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'export_product')->withPivot('quantity','price','sub_total','total','discount','discount_total');
    }

    public function getProductAttribute()
    {
        return $this->products->first();
    }
}
