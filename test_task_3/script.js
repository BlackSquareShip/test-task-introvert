// widgetNameIntr - уникальное имя вашего виджета, должно коррелировать с его назначением

CreateStatusColor = function() {
    var widget = this;
    this.code = null;

    this.yourVar = {};
    this.yourFunc = function() {};

    // вызывается один раз при инициализации виджета, в этой функции мы вешаем события на $(document)
    this.bind_actions = function(){
        //пример $(document).on('click', 'selector', function(){});
        console.log('this is bind')
    };

    // вызывается каждый раз при переходе на страницу
    this.render = function() {
        let pipelines = document.querySelector('.pipeline_wrapper');
        let thirdPipeline;
        if(pipelines.querySelector('.pipeline_cell-unsorted').classList.contains('h-hidden')) {
            thirdPipeline = pipelines.children[3];
        } else {
            thirdPipeline = pipelines.children[2];
        }
        let thirdPipelineText = thirdPipeline.querySelector('.block-selectable');
        let underline = thirdPipeline.querySelector('.pipeline_status__head_line');
        let colorOfUnderLine = window.getComputedStyle(underline).color;
        thirdPipelineText.style.color = colorOfUnderLine;
    };

    // вызывается один раз при инициализации виджета, в этой функции мы загружаем нужные данные, стили и.т.п
    this.init = function(){

    };

    // метод загрузчик, не изменяется
    this.bootstrap = function(code) {
        widget.code = code;
        // если frontend_status не задан, то считаем что виджет выключен
        // var status = yadroFunctions.getSettings(code).frontend_status;
        var status = 1;

        if (status) {
            widget.init();
            widget.render();
            widget.bind_actions();
            $(document).on('widgets:load', function () {
                widget.render();
            });
        }
    }
};
// создание экземпляра виджета и регистрация в системных переменных Yadra
// widget-name - ИД и widgetNameIntr - уникальные названия виджета
yadroWidget.widgets['widget-name'] = new CreateStatusColor();
yadroWidget.widgets['widget-name'].bootstrap('widget-name');
