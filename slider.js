var nazwa_slajdu = 'slajd1';

function left()
{

    if (nazwa_slajdu == 'slajd1')
    {
        document.getElementById('slajd1').style.display = "none";
        document.getElementById('slajd2').style.display = "none";
        document.getElementById('slajd3').style.display = "flex";
        nazwa_slajdu = 'slajd3';
    }
    else if (nazwa_slajdu == 'slajd3')
    {
        document.getElementById('slajd1').style.display = "none";
        document.getElementById('slajd2').style.display = "flex";
        document.getElementById('slajd3').style.display = "none";
        nazwa_slajdu = 'slajd2';
    }
    else if (nazwa_slajdu == 'slajd2')
    {
        document.getElementById('slajd1').style.display = "flex";
        document.getElementById('slajd2').style.display = "none";
        document.getElementById('slajd3').style.display = "none";
        nazwa_slajdu = 'slajd1';
    }

}

function right()
{

    if (nazwa_slajdu == 'slajd1')
    {
        document.getElementById('slajd1').style.display = "none";
        document.getElementById('slajd2').style.display = "flex";
        document.getElementById('slajd3').style.display = "none";
        nazwa_slajdu = 'slajd2';
    }
    else if (nazwa_slajdu == 'slajd2')
    {
        document.getElementById('slajd1').style.display = "none";
        document.getElementById('slajd2').style.display = "none";
        document.getElementById('slajd3').style.display = "flex";
        nazwa_slajdu = 'slajd3';
    }
    else if (nazwa_slajdu == 'slajd3')
    {
        document.getElementById('slajd1').style.display = "flex";
        document.getElementById('slajd2').style.display = "none";
        document.getElementById('slajd3').style.display = "none";
        nazwa_slajdu = 'slajd1';
    }

}

// let slideIndex = 1;

// function plusSlides(n)
// {
//     showSlides(slideIndex += n);
// }

// function showSlides(n)
// {
//     let i;
//     let slides = document.getElementsByClassName("slajd");

//     if (n > slides.length)
//     {
//         slideIndex = 1;
//     }

//     if (n < 1)
//     {
//         slideIndex = slides.length;
//     }

//     for (i = 0; i < slides.length; i++)
//     {
//         slides[i].style.display = "none";
//     }

//     slides[slideIndex-1].style.display = "flex";
// }