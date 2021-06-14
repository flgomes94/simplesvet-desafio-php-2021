<template>
    <h1 class="table-title">{{titulo}}</h1>
    <table class="table-content" v-if="elementos.length > 0">
    <tr>
        <th v-for="(coluna,key) in colunas" :key="key">{{coluna}}</th>
    </tr>
    <tr v-for="(elemento,key) in elementos" :key="key" class="active-row">
        <td v-for="coluna in colunas" :key="coluna.id">{{elemento[coluna]}}</td>
    </tr>

    </table>
    <p v-if="elementos.length == 0">Sem dados para exibir</p>
</template>
<script>
export default {
  name: 'Table',
  props: {
    colunas: { type: Array },
    titulo: String,
    elementos: { type: Array(Object) },
  },
};
</script>
<style>
.table-title{
    font-size:30px;
    text-transform: uppercase;
    color: #8ba3b0;
    width:50%;
    text-align:center;
}

.table-content{
    width:100%;
    max-width:50%;
    border-spacing: 5px;
}

table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  text-align:center;
}

th, td {
  padding: 15px;
}

th {
    text-transform: capitalize;
    background-color: #8c4493;
}

.table-content tr:nth-child(even) {
  background-color: #eee;
}
.table-content tr:nth-child(odd) {
  background-color: #fff;
}

</style>
