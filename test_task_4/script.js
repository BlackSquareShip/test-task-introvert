// widgetNameIntr - уникальное имя вашего виджета, должно коррелировать с его назначением

CreateStatusColor = function() {
    var widget = this;
    this.code = null;

    this.yourVar = {};
    this.yourFunc = function() {};

    // вызывается один раз при инициализации виджета, в этой функции мы вешаем события на $(document)
    this.bind_actions = function(){
        //пример $(document).on('click', 'selector', function(){});
        let tip = document.querySelectorAll('.googling');
        tip.forEach((elem)=>{
            elem.addEventListener('click', function (event){
                let searchField = event.target;
                while(!searchField.classList.contains('tips')) {
                    searchField = searchField.parentElement
                }
                searchField = searchField.previousElementSibling.getElementsByTagName('input')[0].getAttribute('value')
                console.log(searchField)
                window.open(`https://yandex.ru/search/?text=${searchField}`, '_blank');
                window.open(`http://letmegooglethat.com/?q=${searchField}`, '_blank');
            })
        })

    };

    // вызывается каждый раз при переходе на страницу
    this.render = function() {
        let allTips = [];
        let phones = document.querySelectorAll('.control-phone')
            phones.forEach((elem)=>{
            allTips.push(elem.nextElementSibling)
        })
        let elemWithMail = document.querySelectorAll('div[data-pei-code="email"]')
        elemWithMail.forEach((elem)=>{
            if(elem.lastElementChild.querySelector('.tips__inner')) {
                allTips.push(elem.lastElementChild)
            }
        })
        console.log(allTips)
        allTips.forEach((tip)=>{
            console.log(tip)
            let tips = tip.querySelector('.tips__inner')
            let googling = document.createElement("div")
            googling.classList.add("tips-item", "js-tips-item", "js-cf-actions-item")
            tips.append(googling);
            googling.innerHTML = '<svg class=" tips-icon icon-inline svg-icon svg-common--filter-search-dims"><use xlink:href="#common--filter-search"></use></svg><span class="googling">Нагуглить</span>';
        })
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
