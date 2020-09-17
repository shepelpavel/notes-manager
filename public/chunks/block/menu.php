<div class="menu js-menu">
    <div class="button menu-trigger js-menu-trigger">
        <span class="menu-trigger_line menu-trigger_line1"></span>
        <span class="menu-trigger_line menu-trigger_line2"></span>
    </div>
    <div class="menu__inner">
        <div class="button menu__inner_link js-add-pass">
            Добавить пароль
        </div>
        <div class="button menu__inner_link js-add-group">
            Добавить каталог
        </div>
        <div class="menu__inner_generator">
            <div class="generator_item generator_title">
                Генератор
            </div>
            <div class="generator_item generator_length">
                <input class="input js-generate-length" type="number" name="length" value="12" min="4" max="40">
            </div>
            <div class="checkbox generator_item generator_num">
                <input class="input js-generate-num" type="checkbox" name="num" id="checkbox_num" checked>
                <label class="label" for="checkbox_num">
                    Цифры
                </label>
            </div>
            <div class="checkbox generator_item generator_sym">
                <input class="input js-generate-sym" type="checkbox" name="sym" id="checkbox_sym" checked>
                <label class="label" for="checkbox_sym">
                    Спецсимволы
                </label>
            </div>
            <div class=" button generator_item generator_button js-generate-button">
                Сгенерировать
            </div>
            <div class="generator_item generator_result">
                <pre class="result js-generate-password">---</pre>
            </div>
        </div>
        <div class="button menu__inner_link js-show-all">
            Изменить ключ
        </div>
    </div>
</div>