## Laravel 9

-Es necesario tener php 8
-MYSQL

### Fase 1 (Generar y exportar base de datos)

-   Tener configurado el enviroment
-   Correr las migrasiones "php artisan migrate" o "php artisan migrate:fresh" si deseas refrescar nuevamente la base.
-   Correr tinker "php artisan tinker", como consideracion, es necesario correrlo en un equipo con buenos recursos, ya que el excel trae mucha informacion, la cual sera insertada a distintas tablas de la blase de datos.
-   Importar el paquete Maatwebsite\Excel "use Maatwebsite\Excel\Facades\Excel; use App\Imports\CodesImport);", utilice este recurso para leer el excel, partirlo por paginas y hacer una insercion masiva en secciones de 500 en 500.
-   Instanciar mi metodo de insercion "Excel::import($import, 'public/CPdescarga.xls');", puedes modificar el archivo CodesImport, para solo rellenar la base de datos con un estado o bien, hacer por varias secciones, segun la capacidad del equipo donde desees agregarlo.
-   Si sigues estos pasos, seguramente ya tienes una base de datos, si por alguna razon no te es posible no te preocupes, te dejare en el repositorio la base de datos en ".sql", listo para que la exportes directamente a tu base de datos.

### Fase 2 (Crear el servicio)

-   Modelo y relacion, estos parten a partir de localities, en esta tabla unicamente guardamos lo necesario (zip_code, locality, state_id, municipality_id) y no repetimos ningun campo.
-   Tiene las siguientes relaciones
-   federal_entity() = $this->hasOne(State::class, 'id', 'state_id') // Extraemos al estado al que pertenece
-   settlements() = $this->hasMany(Settlement::class)->with('settlement_type') //Traemos sus respectivos settlements y a cada uno su respectivo settlement_type
-   municipality() = $this->belongsTo(Municipality::class) // Extraemos al municipio al que pertenece

## Notas

-   Agregue la herramienta de debug telescope, donde pude revisar las peticiones y de que forma marcaba error a la hora de intentar aprobar la prueba, te dejo la URL, disponible\*
    https://zipcodes-test.apptechmx.com.mx/telescope/requests
-   Cabe mencionar que primero monte en una EC2(AWS) todo el proyecto y lo puse disponble, pero no me era necesario implementar un certificado y para eso, tendria que agregar un dominio, por lo que opte por usar uno de mis dominios compartidos. (IP EC2 http://18.221.65.239/api/zip-codes/29096)
