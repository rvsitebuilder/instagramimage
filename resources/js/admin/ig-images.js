
//import 'jquery-ui-bundle'
parentWindow = parent.window;
$(function() {
    $(document).ready(function() {
        addInstagramTab();
    });

    function addInstagramTab() {
        var tabs = parent.$('#imageLib-tabs').tabs();
        tabs.on('tabsactivate', function(event, ui) {
            var active = parent.$('#imageLib-tabs').tabs('option', 'active');
            var imgUl = parent
                .$('#imageLib-tabs')
                .find('ul')
                .find('li');
            activeTab = imgUl
                .eq(active)
                .find('a')
                .attr('href');
            parent.$('.imageBoxView-instagram').hide();

            if (activeTab == '#instragramImage') {
                parent.$('.imageBoxView-instagram').show();
            }
        });
        var ul = tabs.find('ul');

        var igtab = $(
            '<li><a href="#instragramImage"><i class="rv-icon uk-icon-instagram" style="font-size: 24px;"></i></a></li>'
        ).bind('click', function() {
            $('.ui-tabs-animate')
                .addClass('ui-tabs-animateOut')
                .removeClass('ui-tabs-animate');
        });
        ul.find('li')
            .eq(1)
            .after(igtab);
        $(
            '<div id="instragramImage" class="subtabImage ui-panel-height"><iframe name="igTag" id="igTag" src="https://social.rvsitebuilder.com/instagram/igTagList.php" style="width:auto; height:430px; margin:0 -8px;"></iframe></div>'
        ).appendTo(tabs);
        tabs.tabs('refresh');
        $(
            '<div class="imgmanager-panel-scrollbar imageBoxView-instagram imageBoxView-common"><div class="igview" ></div></div>'
        ).insertBefore(parent.$('.imageBoxView-myimageSelection'));
    }
    $(document).bind('editorReady', function() {
        console.log('editorReady instagram plugins');

        //
    });
});

parentWindow.addEventListener('message', function(e) {
    if (e.origin !== 'https://social.rvsitebuilder.com') return;
    console.log(e.origin);
    console.log(e);
    data = e.data;
    try {
        data = jQuery.parseJSON(data);
    } catch (e) {
        console.log(e);
        return;
    }
    switch (data.action) {
        case 'igTags':
            var tags = data.data.split(',');
            console.log(tags);
            break;
        case 'igPhoto':
            var igImage = $(
                '<div class="imageBlock rv_photo">' +
                    '<img class="imageItems" alt="" src="' +
                    parent.wex.url.WYS_IMG_URL +
                    'images/spacer.gif"' +
                    ' width="100%" id="fb-photo' +
                    data.id +
                    '" " ' +
                    ' style="background:#ffffff url(' +
                    data.picture +
                    ')  no-repeat 50% / contain;"> ' +
                    ' <div class="imageTools" style="">' +
                    '<span class=" icon-padd uk-icon-pencil" style="color:#fff;display:none;"></span>' +
                    '<span title="Insert and Download to My Images" class="insert icon-padd uk-icon-medium uk-icon-download"' +
                    'style="color:#fff;font-size: 150%"' +
                    'data="' +
                    data.source +
                    '">' +
                    '</span>' +
                    '</div></div>'
            );
            igImage.find('.insert').click(function() {
                RVwys.imagemanager.eventDownloadImg($(this));
            });

            $('.igview').append(igImage);
            break;
        case 'igClear':
            $('.igview').html('');
            break;
        case 'igLogin':
            igMsgView =
                '<div class="fb-msgSelectAlbum msgblock-info-im">select tag instagram left menu</lang></div>';
            $('.igview').html(igMsgView);
            break;
        case 'igLogout':
            igMsgView = $('<div class="ig-msgSelectTag">Please login Instagram</div>');
            parent
                .$('.igview')
                .html('')
                .append(igMsgView);
            break;
        case 'igMore':
            var igmore = $(
                '<div class="igmore checkleft"><button limit=100 offset=100 class="btn-input padlt">More</button></div>'
            );
            igmore.find('button').click(function() {
                frameIG = parent.document.getElementById('igTag').contentWindow;
                frameIG.postMessage('morephoto', '*');
            });
            $('.igview').append(igmore);
            break;
        default:
            break;
    }
});
