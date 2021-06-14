<template>
  <img src="./assets/logo.svg" style="width: 50%;">
  <Upload :updateFunction="getData"/>
  <Table titulo='Pessoas' :colunas="colunasPessoas" :elementos="elementosPessoas" />
  <Table titulo='Contatos' :colunas="colunasContatos" :elementos="elementosContatos"/>
  <Table titulo='Espécies' :colunas="colunasEspecies" :elementos="elementosEspecies"/>
  <Table titulo='Raças' :colunas="colunasRacas" :elementos="elementosRacas"/>
  <Table titulo='Animais' :colunas="colunasAnimais" :elementos="elementosAnimais"/>
</template>

<script>
import Upload from './components/Upload.vue';
import Table from './components/Table.vue';
import api from './services/api';

export default {
  name: 'App',
  components: {
    Upload,
    Table,
  },
  data() {
    return {
      colunasPessoas: [],
      elementosPessoas: [],
      colunasContatos: [],
      elementosContatos: [],
      colunasEspecies: [],
      elementosEspecies: [],
      colunasRacas: [],
      elementosRacas: [],
      colunasAnimais: [],
      elementosAnimais: [],
    };
  },
  methods: {
    /* eslint-disable */
      getData() {
        /* eslint-disable */
    api
      .get('/pessoas')
      .then((response) => {this.colunasPessoas = response.data.headers;
        this.elementosPessoas = response.data.data;
        }
      );
      /* eslint-disable */
    api
      .get('/contatos')
      .then((response) => {this.colunasContatos = response.data.headers;
        this.elementosContatos = response.data.data;
        }
      );
        /* eslint-disable */
    api
      .get('/especies')
      .then((response) => {this.colunasEspecies = response.data.headers;
        this.elementosEspecies = response.data.data;
        }
      );
       /* eslint-disable */
    api
      .get('/racas')
      .then((response) => {this.colunasRacas = response.data.headers;
        this.elementosRacas = response.data.data;
        }
      );
         /* eslint-disable */
    api
      .get('/animais')
      .then((response) => {this.colunasAnimais = response.data.headers;
        this.elementosAnimais = response.data.data;
        }
      );
    }
  },
  mounted() {
    this.getData();
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
