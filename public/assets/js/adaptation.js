// written by SQS

var textSize = 0;
function normalSize()
{
    const elements = document.querySelectorAll('*');

    var normalSize = document.querySelector('#normalSize');
        normalSize.classList.add('active-size');
    var decreaseSize = document.querySelector('#decreaseSize');
        decreaseSize.classList.remove('active-size');
    var increaseSize = document.querySelector('#increaseSize');
        increaseSize.classList.remove('active-size');

    if(textSize < 0)
    {
        elements.forEach(element => {
            // Get the current font size
            const currentSize = window.getComputedStyle(element).fontSize;
        
            // Convert current size to a number and add 2px
          
            const newSize = parseFloat(currentSize) + 2;  
        
            // Set the new font size
            element.style.fontSize = newSize + 'px';
        });
    }

    if(textSize > 0)
        {
            elements.forEach(element => {
                // Get the current font size
                const currentSize = window.getComputedStyle(element).fontSize;
            
                // Convert current size to a number and add 2px
              
                const newSize = parseFloat(currentSize)- 2;  
            
                // Set the new font size
                element.style.fontSize = newSize + 'px';
            });
        }
    textSize = 0;
}



function increaseSize()
{
    const elements = document.querySelectorAll('*');

    var normalSize = document.querySelector('#normalSize');
        normalSize.classList.remove('active-size');
    var decreaseSize = document.querySelector('#decreaseSize');
    decreaseSize.classList.remove('active-size');
    var increaseSize = document.querySelector('#increaseSize');
    increaseSize.classList.add('active-size');
    
    if(textSize == 0)
    {
        elements.forEach(element => {
            
            // Get the current font size
            const currentSize = window.getComputedStyle(element).fontSize;
            
            // Convert current size to a number and add 2px
            const newSize = parseFloat(currentSize) + 2;
     
            element.style.fontSize = newSize + 'px';
            
        });
    }
    if(textSize == -2)
    {
        elements.forEach(element => {
            const currentSize = window.getComputedStyle(element).fontSize;

            const newSize = parseFloat(currentSize) + 4;
        
            element.style.fontSize = newSize + 'px';
        });
    }
    textSize = 2;
}


function decreaseSize()
{
    
    const elements = document.querySelectorAll('*');
    var normalSize = document.querySelector('#normalSize');
        normalSize.classList.remove('active-size');
    var decreaseSize = document.querySelector('#decreaseSize');
    decreaseSize.classList.add('active-size');
    var increaseSize = document.querySelector('#increaseSize');
    increaseSize.classList.remove('active-size');

    if(textSize == 0)
    {
        elements.forEach(element => {
            const currentSize = window.getComputedStyle(element).fontSize;
          
            const newSize = parseFloat(currentSize) - 2;  

            element.style.fontSize = newSize + 'px';
        });
    }
    if(textSize == 2)
    {
        elements.forEach(element => {
            const currentSize = window.getComputedStyle(element).fontSize;
            
            const newSize = parseFloat(currentSize) - 4;  

            element.style.fontSize = newSize + 'px';
        });
    }
    
    textSize = -2;
}














function applyGrayscale() {
    document.body.style.filter = 'grayscale(100%)';
    localStorage.setItem('grayscaleApplied', 'true'); // Grayscale holatini localStorage'ga saqlash
}

function applyEyeBox() {
    document.querySelector('.eyes-box').classList.add('d-flex');
    document.querySelector('.eyes-box').classList.remove('d-none');
    localStorage.setItem('applyeyeBox', 'true');
}

function applyIncreased() {
    increaseSize();
    localStorage.setItem('sizeIncreased', 'true'); // Grayscale holatini localStorage'ga saqlash
}
function applyDecreased() {
    decreaseSize();
    localStorage.setItem('sizeDecreased', 'true'); // Grayscale holatini localStorage'ga saqlash
}

// Grayscale tasirini olib tashlash
function removeGrayscale() {
    document.body.style.filter = ''; // Grayscale tasirini olib tashlash
    localStorage.setItem('grayscaleApplied', 'false'); // Grayscale holatini localStorage'ga saqlash
}

function removeEyeBox() {
    document.querySelector('.eyes-box').classList.add('d-none');
    document.querySelector('.eyes-box').classList.remove('d-flex');
    localStorage.setItem('applyeyeBox', 'false');
}

function removeIncreased() {
    normalSize();
    localStorage.setItem('sizeIncreased', 'false'); // Grayscale holatini localStorage'ga saqlash
}
function removeDecreased() {
    normalSize();
    localStorage.setItem('sizeDecreased', 'false'); // Grayscale holatini localStorage'ga saqlash
}

// Sahifa yuklanganda grayscale holatini tekshirish va kerakli tasirni qo'llash
function checkGrayscaleState() {
    const grayscaleApplied = localStorage.getItem('grayscaleApplied');
    if (grayscaleApplied === 'true') {
        applyGrayscale(); // Agar tasir saqlangan bo'lsa, grayscale qo'llash
    }

    const applyeyeBox = localStorage.getItem('applyeyeBox');
    if (applyeyeBox === 'true') {
        applyEyeBox(); // Agar tasir saqlangan bo'lsa, grayscale qo'llash
    }

    const sizeIncreased = localStorage.getItem('sizeIncreased');
    if (sizeIncreased === 'true') {
        applyIncreased(); // Agar tasir saqlangan bo'lsa, grayscale qo'llash
    }

    const sizeDecreased = localStorage.getItem('sizeDecreased');
    if (sizeDecreased === 'true') {
        applyDecreased(); // Agar tasir saqlangan bo'lsa, grayscale qo'llash
    }
}

// Sahifa yuklanganda checkGrayscaleState funksiyasini chaqirish
window.onload = checkGrayscaleState;
// Grayscale ni yoqish yoki o'chirish uchun misol tugmasi
document.getElementById('toggleGrayscale').addEventListener('click', function() {
    const grayscaleApplied = localStorage.getItem('grayscaleApplied');
    if (grayscaleApplied === 'true') {
        removeGrayscale(); // Agar grayscale qo'llangan bo'lsa, olib tashlash
    } else {
        applyGrayscale(); // Agar grayscale qo'llanmagan bo'lsa, qo'llash
    }
});

document.getElementById('toggleEyeBox').addEventListener('click', function() {
    const applyeyeBox = localStorage.getItem('applyeyeBox');
    if (applyeyeBox === 'true') {
        removeEyeBox(); // Agar grayscale qo'llangan bo'lsa, olib tashlash
        removeGrayscale();
        removeIncreased();
        removeDecreased();
    } else {
        applyEyeBox(); // Agar grayscale qo'llanmagan bo'lsa, qo'llash
    }
});

document.getElementById('increaseSizeBtn').addEventListener('click', function() {
    const sizeIncreased = localStorage.getItem('sizeIncreased');
    if (sizeIncreased === 'true') {
        removeIncreased(); // Agar grayscale qo'llangan bo'lsa, olib tashlash
    } else {
        applyIncreased(); // Agar grayscale qo'llanmagan bo'lsa, qo'llash
    }
});

document.getElementById('normalSizeBtn').addEventListener('click', function() {
    normalSize();
    localStorage.setItem('sizeIncreased', 'false');
    localStorage.setItem('sizeDecreased', 'false');
});

document.getElementById('decreaseSizeBtn').addEventListener('click', function() {
    const sizeDecreased = localStorage.getItem('sizeDecreased');
    if (sizeDecreased === 'true') {
        removeDecreased(); // Agar grayscale qo'llangan bo'lsa, olib tashlash
    } else {
        applyDecreased(); // Agar grayscale qo'llanmagan bo'lsa, qo'llash
    }
});




















// var colorfull = true;
// function wbColor()
// {
//     if(colorfull)
//     {
//         const elements = document.querySelectorAll('*');
//         elements.forEach(element => {

//             element.style.backgroundColor = 'black';
//             element.style.color = 'white';
//         });
//         colorfull = false;
//     }else{
//         colorfull = true;
//         location.reload();
//     }
    
// }