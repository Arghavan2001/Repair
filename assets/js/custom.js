jQuery(document).ready(function($) {
  const $myhumburger = $('.myhumburger');
  const $menu = $('.main-menu');
  const $subMenu = $('.sub-menu');

  // همبرگر منو
  if ($myhumburger.length && $menu.length) {
    $myhumburger.on('click', function () {
      $menu.toggleClass('active');
      $myhumburger.toggleClass('open');
    });
  }

  // ریسایز صفحه
  $(window).on('resize', function () {
    $menu.removeClass('active');
    $myhumburger.removeClass('open');
  });

  let lastClickTime = 0;
  let lastClicked = null;
  
  $('.menu-item-has-children > a').on('click', function (e) {
    const now = new Date().getTime();
    const $this = $(this);
  
    // اگر کلیک سریع دوم روی همون لینک بود، بفرست به لینک
    if (lastClicked && lastClicked.is($this) && (now - lastClickTime) < 500) {
      window.location.href = $this.attr('href');
      return;
    }
  
    // اگر کلیک اول بود، فقط منو رو باز کن و نرو به لینک
    e.preventDefault();
  
    // ذخیره اطلاعات کلیک اول
    lastClickTime = now;
    lastClicked = $this;
  });

  // فرم درخواست
  const $openBtn = $('#open-form');
  const $closeBtn = $('#close-form');
  const $wrapper = $('#request-form-wrapper');

  if ($openBtn.length && $closeBtn.length && $wrapper.length) {
    $openBtn.on('click', function (e) {
      e.preventDefault();
      $wrapper.css('display', 'flex');
    });

    $closeBtn.on('click', function () {
      $wrapper.css('display', 'none');
    });
  }

  //start form
  $('#request-form').on('submit', function (e) {
    e.preventDefault(); // جلوگیری از رفرش شدن فرم

    // پاک‌کردن خطاهای قبلی
    $('#er-name, #er-phone, #er-device, #er-description, #er-city, #suc, #err').text('');

    // گرفتن مقادیر فیلدها
    const fullName = $.trim($(this).find('[name="fullName"]').val());
    const phone = $.trim($(this).find('[name="phone"]').val());
    const device = $(this).find('[name="device"]').val();
    const description = $(this).find('[name="description"]').val();
    const city = $(this).find('[name="city"]').val();

    let hasError = false;

    if (fullName.length < 3) {
      $('#er-name').text('نام معتبر وارد کنید');
      hasError = true;
    }

    const phoneRegex = /^(09\d{9}|0\d{2,4}-?\d{7,8})$/;
    if (!phoneRegex.test(phone)) {
      $('#er-phone').text('شماره تماس معتبر وارد کنید');
      hasError = true;
    }

    if (!device) {
      $('#er-device').text('نوع دستگاه را انتخاب کنید');
      hasError = true;
    }

    if (!description || description.length < 3) {
      $('#er-description').text('ایراد دستگاه را وارد کنید');
      hasError = true;
    }

    if (!city) {
      $('#er-city').text('شهر را انتخاب کنید');
      hasError = true;
    }

    if (!hasError) {
      fetch(my_ajax.ajax_url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          action: 'submit_request_form',
          fullName,
          phone,
          device,
          description,
          city
        }),
      })
      .then(response => response.text())
      .then(data => {
        $('#suc').text(data);
      })
      .catch(() => {
        $('#err').text('خطا در ارسال درخواست');
      });
    }
  });
  //end form

  //start search
  $('#search-box').on('submit', function(e) {
    var searchQuery = $('#search-input').val().trim();
    
    // اگر فیلد جستجو خالی بود، جلوی ارسال فرم را بگیریم
    if (searchQuery === '') {
        e.preventDefault(); // جلوگیری از ارسال فرم
        $("#search-input").focus();
    }
});

  //end search
});
