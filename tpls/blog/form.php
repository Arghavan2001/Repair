<div id="request-form-wrapper">
  <form id="request-form">
    <h2>درخواست خدمات</h2>

    <button type="button" id="close-form" class="close-button">✖</button>

    <input type="text" name="fullName" placeholder="نام و نام‌خانوادگی">
    <div id="er-name" class="error"></div>

    <input type="tel" name="phone" placeholder="شماره تماس(موبایل / تلفن با پیش شماره)">
    <div id="er-phone" class="error"></div>

    <select name="device">
      <option value="">نوع دستگاه</option>
      <option>یخچال</option>
      <option>لباسشویی</option>
      <option>ظرفشویی</option>
    </select>
    <div id="er-device" class="error"></div>

    <input type="text" name="description" placeholder="مشکل دستگاه">
    <div id="er-description" class="error"></div>
    
    <input type="text" name="city" value="تهران" readonly>
    <div id="er-city" class="error"></div>

    <div id="suc" class="successful"></div>
    <div id="err" class="error"></div>

    <button type="submit">ارسال</button>

  </form>
</div>
