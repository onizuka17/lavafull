const laravelNuxt = require("laravel-nuxt");

module.exports = laravelNuxt({
	mode: 'universal',
    modules: [
    	'@nuxtjs/axios',
    ],
    plugins: [],
});
