<template>
    <div class="container">
      <h1>Upload de Arquivos</h1>
      <div>
        <p>{{animais.name  || ""}}</p>
        <label>Selecionar Arquivos Animais
          <input type="file" id="animais" ref="animais" v-on:change="handleFileUploadAnimais()"/>
        </label>
      </div>
      <div>
      <p>{{clientes.name || ""}}</p>
        <label>Selecionar Arquivos Clientes
          <input type="file" id="clientes" ref="clientes" v-on:change="handleFileUploadClientes()"/>
        </label>
      </div>
      <div class="upload-button">
      <p v-if="this.isLoading">Carregando...</p>
      <button v-on:click="submitFiles()">Carregar</button>
      </div>
  </div>
</template>
<script>
import api from '../services/api';

export default {
  name: 'UploadFile',
  props: {
    updateFunction: Function,
  },
  data() {
    return {
      animais: '',
      clientes: '',
      isLoading: false,
    };
  },
  methods: {
    handleFileUploadAnimais() {
      // eslint-disable-next-line prefer-destructuring
      this.animais = this.$refs.animais.files[0]; // o segundo é um tamanho
    },
    handleFileUploadClientes() {
      // eslint-disable-next-line prefer-destructuring
      this.clientes = this.$refs.clientes.files[0]; // o segundo é um tamanho
    },
    submitFiles() {
      const formData = new FormData();
      formData.append('animais', this.animais);
      formData.append('clientes', this.clientes);
      this.isLoading = true;
      api.post('http://172.24.148.212:8000/upload',
        formData,
        {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        }).then(() => {
        this.updateFunction();
        this.isLoading = false;
      })
        .catch(() => {
          this.isLoading = false;
        });
    },
  },

};
</script>
<style>
.container h1{
  font-size:30px;
  text-transform:uppercase;
  color: #8ba3b0;
  text-align: center;
  margin:20px 0px;
}

.container input[type='file'] {
  display: none;
}

.container label {
  cursor:pointer;
  padding: 20px 10px;
  background-color: #333;
  color: #FFF;
  text-transform: uppercase;
  text-align: center;
  display: block;
}

.container p {
  font-size:12px;
  text-align:center;
  color: #ea515b;
  height:14px;
}

.container button {
    background-color: #44bccb;
    color:#fff;
    text-transform:uppercase;
    margin:0px;
    height:40px;
    box-shadow: 0 0 0 #fff;
    border: 0 solid #fff;
    border-radius: 3px;
    width:100%;
}

.upload-button{
  margin:20px 0px;
}
</style>
