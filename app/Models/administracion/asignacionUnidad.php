<?php

namespace App\Models\administracion;

use App\Models\catalogos\plazoArrendamiento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\configuracion\cliente;
use App\Models\configuracion\responsable;
use App\Models\configuracion\unidad;
use App\Models\funciones\MantenimientoCallCenter;

class asignacionUnidad extends Model
{
    use HasFactory;


    protected $table = 'asignacion_unidades';
    protected $primaryKey = 'id_asignacion_unidad';
    protected $fillable = [
        'id_cliente',
        'id_unidad',
        'id_responsable',
        'plazo_arrendamiento',
        'fecha_inicial',
        'fecha_final',

        'placas',
        'terminacion_placas',
        'primer_semestre',
        'segundo_semestre',
        'cambio_laminas',
        'reposicion_laminas',
        'a_alta_placas',
        'a_derechos_vehiculares',
        'a_tarjeta_circulacion',
        'cambio_tarjeta_circulacion',

        'politica_uso',
        'informacion_movilidad',
        'comunicados_generales',
        'informacion_mormont',
        'talon_verificacion',
        'llave_repuesto',
        'gato_hidraulico',
        'triangulo_seguridad',
        'manual_usuario',
        'engomado',
        'placas_check',
        'poliza_mantenimiento',
        'llanta_refaccion',
        'poliza_seguro',
        'tarjeta_circulacion',
        'a_entrega',
        'activo',
        'etapa',
        'estado',
    ];

    public function Unidad(): BelongsTo
    {
        return $this->belongsTo(unidad::class,'id_unidad');
    }
    public function Cliente(): BelongsTo
    {
        return $this->belongsTo(cliente::class, 'id_cliente', 'id_cliente');
    }
    public function Responsable(): BelongsTo
    {
        return $this->belongsTo(responsable::class,'id_responsable','id_responsable');
    }
    public function Unidad_garantias(): HasMany
    {
        return $this->hasMany(unidadGarantia::class,'id_asignacion_unidad', 'id_asignacion_unidad')->where('tipo','GARANTIAS EXTENDIDAS');
    }
    public function DetallesAsignacion(): HasMany
    {
        return $this->hasMany(detalleAsignacion::class,'id_asignacion_unidad','id_asignacion_unidad');
    }
    public function DetalleAsignacion(): HasOne
    {
        return $this->hasOne(detalleAsignacion::class,'id_asignacion_unidad','id_asignacion_unidad')->latestOfMany('id_asignacion_unidad');
    }
    public function Plazo(): HasOne
    {
        return $this->hasOne(plazoArrendamiento::class,'id_plazo','plazo_arrendamiento');
    }
    public function asignacionSeguro()
    {
        return $this->hasOne(asignacionPoliza::class, 'id_unidad', 'id_unidad');
    }
    public static function getUnidad($cliente_id)
    {
        return self::with(['Unidad' => function ($query) {
            $query->whereHas('datosAseguradora');
        }])
        ->where('id_cliente', $cliente_id)
        ->where('activo', 1)
        ->get();
    }
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha_inicial' => 'date',
            'fecha_final' => 'date',
        ];
    }
}
