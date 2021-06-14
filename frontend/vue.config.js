module.exports = {
    chainWebpack: config => {
        config
            .plugin('html')
            .tap(args => {
                args[0].title = "Desafio Simplesvet PHP 2021 🐾";
                return args;
            })
    }
}