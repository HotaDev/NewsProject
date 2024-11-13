BX.ready(function () {
    const componentApp = BX.Vue.create({
        el: '#component_banner',
        data: function () {
            return {

                // добавьте данные к примеру:
                example: null,
                ajaxUrl: "firstbit:web.main.banner",
            };
        },

        methods: {
            // Методы компонента
            LoaderMethod() {
            },
        }
        // Остальные опции компонента
    });
});