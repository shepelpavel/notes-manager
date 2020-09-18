var editor_settings = {
    width: '100%',
    height: 300,
    extraPlugins: 'autogrow',
    autoGrow_minHeight: 300,
    autoGrow_maxHeight: 0,
    toolbarGroups: [{
            name: 'document',
            groups: ['mode', 'document', 'doctools']
        },
        {
            name: 'clipboard',
            groups: ['clipboard', 'undo']
        },
        {
            name: 'editing',
            groups: ['find', 'selection', 'spellchecker', 'editing']
        },
        {
            name: 'forms',
            groups: ['forms']
        },
        '/',
        {
            name: 'basicstyles',
            groups: ['basicstyles', 'cleanup']
        },
        {
            name: 'paragraph',
            groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
        },
        {
            name: 'links',
            groups: ['links']
        },
        {
            name: 'insert',
            groups: ['insert']
        },
        '/',
        {
            name: 'styles',
            groups: ['styles']
        },
        {
            name: 'colors',
            groups: ['colors']
        },
        {
            name: 'tools',
            groups: ['tools']
        },
        {
            name: 'others',
            groups: ['others']
        },
        {
            name: 'about',
            groups: ['about']
        }
    ],
    removeButtons: 'Save,Paste,PasteText,PasteFromWord,About,Language,BidiRtl,BidiLtr,PageBreak,Flash'
};

// функция получения контента каталогов
function getContent(path) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/get_content.php',
        data: "path=" + path,
        success: function (data) {
            $('#page').animate({
                opacity: 0
            }, 300, function () {
                $('#page').html(data);
                $(window).scrollTop(0);
            });
            $('#page').animate({
                opacity: 1
            }, 300);
        }
    });
}

// функция получения содержимого заметки
function getNotes(name) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/get_notes.php',
        data: "name=" + name,
        success: function (data) {
            $('#page').animate({
                opacity: 0
            }, 300, function () {
                $('#page').html(data);
                $('#editor').text(decodeURIComponent(escape(window.atob($('#editor').text()))));
                $(window).scrollTop(0);
                CKEDITOR.replace('editor', editor_settings);
            });
            $('#page').animate({
                opacity: 1
            }, 300);
        }
    });
}

// функция добавления каталога
function addGroup(name) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/add_group.php',
        data: "name=" + name,
        success: function (data) {
            if (data == 'error') {
                alert('Error!');
            } else if (data == 'exist') {
                alert('Folder exist!');
            } else {
                getContent(data);
            }
        }
    });
}

// функция изменения каталога
function editGroup(name, oldname) {
    var group = {
        name: name,
        oldname: oldname
    };
    $.ajax({
        type: 'POST',
        url: '/core/fn/edit_group.php',
        data: group,
        success: function (data) {
            if (data == 'error') {
                alert('Error!');
            } else if (data == 'exist') {
                alert('Folder exist!');
            } else {
                getContent(data);
            }
        }
    });
}

// функция получения страницы добавления заметки
function getAddNotesPage() {
    $.ajax({
        type: 'POST',
        url: '/core/fn/add_notes_page.php',
        success: function (data) {
            $('#page').animate({
                opacity: 0
            }, 300, function () {
                $('#page').html(data);
                $(window).scrollTop(0);
                CKEDITOR.replace('editor', editor_settings);
            });
            $('#page').animate({
                opacity: 1
            }, 300);
        }
    });
}

// функция сохранения новой заметки
function saveNewNotes(name, arr) {
    var data = {
        name: name,
        arr: arr
    };
    $.ajax({
        type: 'POST',
        url: '/core/fn/add_new_notes.php',
        data: data,
        success: function (data) {
            if (data == 'error') {
                alert('Error!');
            } else {
                getContent(data);
            }
        }
    });
}

// функция пересохранения заметки
function saveNotes(name, arr) {
    var data = {
        name: name,
        arr: arr
    };
    $.ajax({
        type: 'POST',
        url: '/core/fn/resave_notes.php',
        data: data,
        success: function (data) {
            if (data == 'error') {
                alert('Error!');
            } else {
                getContent(data);
            }
        }
    });
}

// функция удаления айтема
function delItem(name, type) {
    var item = {
        name: name,
        type: type
    };
    $.ajax({
        type: 'POST',
        url: '/core/fn/del_item.php',
        data: item,
        success: function (data) {
            if (data == 'error') {
                alert('Error!');
            } else {
                getContent(data);
            }
        }
    });
}

// функция нормализация имени файла/папки
function normalizeName(name) {
    var result = name.replace(/[^а-яa-z0-9\_\-\@\.\,\s]/ig, '');
    return result;
}

$(document).ready(function () {

    // получение стартовой страницы
    getContent('HOME');

    // получение страницы каталога
    $('body').on('click', '.js-tree-path', function () {
        var target_path = $(this).attr('target');

        if (target_path != '' && target_path != null) {
            getContent(target_path);
        } else {
            alert('error');
        }
    });

    // получение страницы заметки
    $('body').on('click', '.js-notes-title', function () {
        var target_path = $(this).attr('target');

        if (target_path != '' && target_path != null) {
            getNotes(target_path);
        } else {
            alert('error');
        }
    });

    // добавление каталога
    $('body').on('click', '.js-add-group', function () {
        var name = normalizeName(prompt("Enter folder name"));

        if (name != '' &&
            name != null) {
            addGroup(name);
        }
    });

    // изменение каталога
    $('body').on('click', '.js-folder-edit', function () {
        var oldname = $(this).closest('.js-tree-item').find('.js-tree-name').attr('target');
        var in_name = normalizeName(prompt('Enter new name', oldname.substr(1)));

        if (in_name != '' &&
            in_name != null) {
            editGroup('/' + in_name, oldname);
        }
    });

    // получение страницы добавления заметки
    $('body').on('click', '.js-add-notes', function () {
        getAddNotesPage();
    });

    // сохранение новой заметки
    $('body').on('click', '.js-newnotes-save', function () {
        var name = $('.js-input-title').val();
        var arr = {
            note: window.btoa(unescape(encodeURIComponent(CKEDITOR.instances.editor.getData())))
        };
        if (name) {
            saveNewNotes(name, arr);
        } else {
            alert('Write name!');
        }
    });

    // сохранение существующей заметки
    $('body').on('click', '.js-notes-save', function () {
        var u_confirm = confirm('Resave?');

        if (u_confirm) {
            var name = $('.js-input-title').val();
            var arr = {
                note: window.btoa(unescape(encodeURIComponent(CKEDITOR.instances.editor.getData())))
            };
            if (name, arr) {
                saveNotes(name, arr);
            } else {
                alert('Write name!');
            }
        }
    });

    // удаление айтема
    $('body').on('click', '.js-tree-del', function () {
        var u_confirm = confirm('Seriously?');

        if (u_confirm) {
            var tree_name = $(this).closest('.js-tree-item').find('.js-tree-name');
            var target_name = $(tree_name).attr('target');
            var target_type = $(tree_name).attr('type');
            var types = ['groups', 'notes'];

            if (target_name != '' &&
                target_name != null &&
                $.inArray(target_type, types) >= 0) {

                delItem(target_name, target_type);
            } else {
                alert('error');
            }
        }
    });

    // нормализация имени файла/каталога
    $('body').on('input', '.js-input-title', function () {
        var inpt = $(this).val();
        var outpt = normalizeName(inpt);
        $(this).val(outpt);
    });

    // перехват клавиши "назад"
    history.pushState(null, null, location.href);
    window.onpopstate = function (e) {
        history.go(1);
    };

});