<template>
    <div class="card">
        <div class="card-header">
            {{ alumno.id}}
        </div>
        <div class="card-body">
            <p>{{alumno.nombre}}</p>           
        </div>
        <div class="card-footer">
            <div class="row">
                <button class="btn btn-small bg-green">Asignar computador</button>
            </div>           
        </div>
    </div>
</template>
<script>
export default {
    props:['alumno']
}
</script>