<?php

namespace App\Models\configuracion;

use App\Models\administracion\asignacionPoliza;
use App\Models\administracion\asignacionUnidad;
use App\Models\administracion\tenencia;
use App\Models\catalogos\estado;
use App\Models\catalogos\marca;
use App\Models\catalogos\tipoUnidad;
use App\Models\catalogos\year;
use App\Models\funciones\citaVerificacion;
use App\Models\configuracion\garantia\garantiaFlisingExtendida;
use App\Models\funciones\asignacioSiniestro;
use App\Models\funciones\MantenimientoCallCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use DB;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

class unidad extends Model
{
    use HasFactory;
    protected $table = "unidades";
    protected $primaryKey = 'id_unidad';

    protected $fillable = [
        'id_tipo_unidad',
        'id_marca',
        'id_estado',
        'id_proveedor',
        'modelo',
        'year',
        'color',
        'n_serie',
        'n_motor',
        'kilometraje',
        'vehiculo_id',
        'fecha_mantenimiento',
        'costo_mantenimiento',
        'a_factura',
        'a_garantia_fabrica',
        'a_manual_servicio',
        'n_factura',
        'codigo_llave',
        'codigo_locker',
        'observaciones',
        'mantenimiento_km',
        'mantenimiento_tiempo',
        'a_garantia_contractual',
        'a_garantia_unidad',
        'activo',
        'created_at',
        'updated_at',
    ];

    public function arrendamientos(): HasMany
    {
        return $this->hasMany(asignacionUnidad::class,'id_unidad')->orderBy('created_at','desc');
    }
    public function estado(): BelongsTo
    {
        return $this->belongsTo(estado::class,'id_estado','id_estado');
    }
    public function UltimoArrendamiento()
    {
        return $this->hasOne(asignacionUnidad::class,'id_unidad')->latestOfMany('id_unidad');
    }
    function anio() : HasOne {
        return $this->hasOne(year::class,'id_year','year');
    }
    public function tipo_unidad(){
        return $this->hasOne(tipoUnidad::class,'id_tipo_unidad','id_tipo_unidad');
    }
    public function marca() {
        return $this->hasOne(marca::class,'id_marca','id_marca');
    }
    public function proveedor() {
        return $this->hasOne(agenciasTalleres::class,'id_proveedor','id_proveedor');
    }

    public function datosAsignacion()
    {
        return $this->hasOne(asignacionUnidad::class, 'id_unidad', 'id_unidad')->latest();
    }

    public function datosAseguradora()
    {
        return $this->hasOne(asignacionPoliza::class, 'id_unidad', 'id_unidad')->latest();
    }
    public static function getProveedor($id_proveedor) {
        $datos = DB::table('proveedores')
        ->join('contactos_servicios','id','id_proveedor')
        ->where('id_proveedor',$id_proveedor)
        ->select('*')
        ->get();

        return $datos;
    }

    public function UltimaVerificacion()
    {
        return $this->hasOne(citaVerificacion::class,'id_unidad')->latestOfMany('id_unidad');
    }
    public function HistorialVerificacion()
    {
        return $this->hasMany(citaVerificacion::class,'id_unidad');
    }
    function tenencia() {
        return $this->hasMany(tenencia::class,'id_unidad','id_unidad');
    }

    public function tieneTenenciaActual()
    {
        $currentYear = Carbon::now()->year;
        return $this->tenencia()->whereYear('created_at', $currentYear)->exists();
    }

    public function sinTenenciaDespuesDeMarzo()
    {
        $currentYear = Carbon::now()->year;
        $marzoTreintaYuno = Carbon::create($currentYear, 3, 31);
        return !$this->tieneTenenciaActual() && Carbon::now()->greaterThan($marzoTreintaYuno);
    }
    function siniestros() {
        return $this->hasMany(asignacioSiniestro::class,'id_unidad');
    }
    public function getNombreArchivoEntregaAttribute()
    {
        return pathinfo($this->UltimoArrendamiento->a_entrega, PATHINFO_BASENAME);
    }

    public function citas_mantenimiento(){
        return $this->hasOne(MantenimientoCallCenter::class,'id_unidad','id_unidad')->orderBy('id_citas_mantenimiento','DESC');
    }
}
