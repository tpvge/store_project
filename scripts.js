
    let count = 0;
    let btn_plus = document.getElementById("buttonCountPlus");
    let btn_minus = document.getElementById("buttonCountMinus");
    let disp = document.getElementById("CountNumber");

    btn_plus.onclick = function () {
        count++;
        disp.value = count;
    }

    btn_minus.onclick = function () {
        if(disp.value >1){
        count--;
        disp.value = count;
        }
    }

     
    function success(){
        if(disp.value<10){
        let lastDigit = disp.value % 10;
        if(lastDigit == 1){
                toastr.success('В корзину добавлено '+ disp.value + ' товар');
        } if((lastDigit > 1) && (lastDigit < 5)){
                toastr.success('В корзину добавлено '+ disp.value + ' товара');
        } if(lastDigit > 4 && lastDigit <10){
                toastr.success('В корзину добавлено '+ disp.value + ' товаров');
        }
    }
    else {
        toastr.success('В корзину добавлено '+ disp.value + ' товаров');
    }
    }

    var big = document.querySelector('.big')
    if (document.querySelectorAll('.images a')) {
      document.querySelectorAll('.images a').forEach(item => {
        item.addEventListener('mouseover', e => {
          big.src = item.href
        })
        item.addEventListener('click', e => {
          e.preventDefault()
          e.stopPropagation()
        })
      })
    }