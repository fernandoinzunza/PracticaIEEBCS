<template>
  <div class="row">
    <div class="col-sm-12" >
      <student-card v-for="alumno in lista" :key="alumno.id" :alumno="alumno"></student-card>
    </div>
  
  </div>
</template>
<script>
export default {
  data() {
    return {
      lista: []
    };
  },
  created() {
    axios.get("/alumnos/getAlumnos").then((response) => {
      this.lista = response.data;
    });
  }
};
</script>