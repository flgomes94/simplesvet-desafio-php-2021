<template>
  <img src="./assets/logo.svg" style="width: 50%;">
  <Upload/>
  <Table titulo='Raças' :colunas="colunasRacas" :elementos="elementosRacas" />
  <Table titulo='Espécies' :colunas="colunasRacas" :elementos="elementosRacas"/>
  <Table titulo='Animais' :colunas="colunasRacas" :elementos="elementosRacas"/>
  <Table titulo='Pessoas' :colunas="colunasRacas" :elementos="elementosRacas"/>
  <Table titulo='Contatos' :colunas="colunasRacas" :elementos="elementosRacas"/>
</template>

<script>
import Upload from './components/Upload.vue';
import Table from './components/Table.vue';

const colunasRacas = ['id', 'especie_id', 'nome'];
const elementosRacas = [
  {
    id: 1,
    especie_id: 1,
    nome: 'canina',
  },
  {
    id: 2,
    especie_id: 1,
    nome: 'felina',
  },
  {
    id: 3,
    especie_id: 1,
    nome: 'canina',
  },

];

export default {
  name: 'App',
  components: {
    Upload,
    Table,
  },
  data() {
    return {
      colunasRacas,
      elementosRacas,
    };
  },
};
</script>

<style>
#app {
  display:flex;
  flex-direction:column;
  justify-content: space-between;
  align-items:center;
  margin-top:10px;
  margin-bottom:10px;
}

* {
    margin: 0;
    padding: 0;
    outline: 0;
    box-sizing: border-box;
  }
  html, body, #root {
    min-height: 100%;
  }
  body {
    background: rgba(0,0,0,0.04);
    -webkit-font-smoothing: antialiased !important;
  }
  body, input, button {
    color: #222;
    font-size: 14px;
    font-family: 'Roboto', sans-serif;
  }
  button {
    cursor: pointer;
  }
</style>
