(() => {
  const formEl = document.querySelector("form.wpcf7-form");
  const formButton = formEl?.querySelector(".wpcf7-submit");
  if (!formEl || !formButton) return;
  const hiddenInput = document.createElement("input");
  hiddenInput.type = "hidden";
  hiddenInput.name = "do_send";
  hiddenInput.value = "false";
  formEl.appendChild(hiddenInput);

  document.addEventListener("wpcf7submit", function (e) {
    const response = e.detail?.apiResponse;
    if (response && response.validation_passed && confirm("入力内容に問題はありません。本当に送信しますか？")) {
      hiddenInput.value = "true";
      formButton.click();
    }
  });

  const files = formEl.querySelectorAll(".wpcf7-file");
  if (files.length > 0) {
    const defaultLabel = "ファイルを<wbr />添付してください";
    files.forEach((file, i) => {
      const el = file.closest(".wpcf7-form-control-wrap");
      if (el === null) return;
      if (!file.getAttribute("id")) {
        file.setAttribute("id", `wpcf7-f${i + 1}-file`);
      }
      const id = file.getAttribute("id");
      const label = document.createElement("label");
      label.setAttribute("for", id);
      label.classList.add("wpcf7-file__label");
      const text = document.createElement("span");
      text.classList.add("wpcf7-file__label__text");
      text.innerHTML = defaultLabel;
      label.appendChild(text);
      el.appendChild(label);
      const deleteButton = document.createElement("button");
      deleteButton.classList.add("wpcf7-file__label__delete");
      deleteButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="currentColor" d="M432 256C432 269.3 421.3 280 408 280h-160v160c0 13.25-10.75 24.01-24 24.01S200 453.3 200 440v-160h-160c-13.25 0-24-10.74-24-23.99C16 242.8 26.75 232 40 232h160v-160c0-13.25 10.75-23.99 24-23.99S248 58.75 248 72v160h160C421.3 232 432 242.8 432 256z"/></svg>`;
      deleteButton.type = "button";
      deleteButton.addEventListener("click", (e) => {
        e.preventDefault();
        file.value = "";
        text.innerHTML = defaultLabel;
        text.classList.remove("is-filled");
      });
      el.appendChild(deleteButton);

      const button = document.createElement("span");
      button.classList.add("wpcf7-file__label__button");
      button.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Pro 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc.--><path d="M375 73c-26-26-68.1-26-94.1 0L89 265C45.3 308.6 45.3 379.4 89 423s114.4 43.6 158.1 0L399 271c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L281 457c-62.4 62.4-163.5 62.4-225.9 0S-7.4 293.4 55 231L247 39C291.7-5.7 364.2-5.7 409 39s44.7 117.2 0 161.9L225.2 384.7c-31.6 31.6-83.6 28.7-111.5-6.2c-23.8-29.8-21.5-72.8 5.5-99.8L271 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L153.2 312.7c-9.7 9.7-10.6 25.1-2 35.8c10 12.5 28.7 13.6 40 2.2L375 167c26-26 26-68.1 0-94.1z"/></svg>ファイルを<wbr />選択`;
      label.appendChild(button);

      file.addEventListener("change", (e) => {
        const fileName = e.target.files[0] ? e.target.files[0].name : "";
        text.innerHTML = fileName || defaultLabel;
        text.classList.toggle("is-filled", !!fileName);
      });
    });
  }
})();
