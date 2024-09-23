// object select element
const selectElement = {
    dropdownBtn: document.getElementsByClassName("dropdown_button"),
    subNavItem: document.getElementsByClassName("dropdown_sub"),
};

// element destructure
let { dropdownBtn, subNavItem } = selectElement;

[...dropdownBtn].forEach((innerBtn, index) => {
    let innerNav = subNavItem[index];
    innerBtn.addEventListener("click", function () {
        $(innerNav).slideToggle();
        $(".dropdown_sub").not(innerNav).slideUp();
        $(".dropdown_button").removeClass("active");
        $(innerBtn).toggleClass("active");
    });
});


// slider start
$(".partner__active").slick({
    dots: false,
    infinite: true,
    speed: 300,
    arrows: false,
    autoplay: true,
    speed: 1000,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
            },
        },
        {
            breakpoint: 800,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});
// slider start
$(".review__active").slick({
    dots: true,
    infinite: true,
    speed: 300,
    arrows: false,
    autoplay: true,
    speed: 2000,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
            },
        },
        {
            breakpoint: 800,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

// slider end

// partnet start

$(".partnet__active").slick({
    dots: true,
    arrows: false,
    infinite: true,
    autoplaySpeed: 1000,
    autoplay: true,
    speed: 600,
    slidesToShow: 5,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 4,
            },
        },
        {
            breakpoint: 1000,
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 400,
            settings: {
                slidesToShow: 2,
            },
        },
    ],
});
// partnet end

// university show/less
$(".show-more").click(function () {
    if ($(".text").hasClass("show-more-height")) {
        $(this).text("(Show Less)");
    } else {
        $(this).text("(Show More)");
    }

    $(".text").toggleClass("show-more-height");
});

// lightbox
lightbox.option({
    resizeDuration: 200,
    wrapAround: true,
    fadeDuration: 600,
    alwaysShowNavOnTouchDevices: true,
});

// scrollup
$.scrollUp({
    scrollName: "scrollUp", // Element ID
    topDistance: "300", // Distance from top before showing element (px)
    topSpeed: 300, // Speed back to top (ms)
    animation: "fade", // Fade, slide, none
    animationInSpeed: 200, // Animation in speed (ms)
    animationOutSpeed: 200, // Animation out speed (ms)
    scrollText: '<i class="fa-solid fa-angle-up"></i>', // Text for element
    activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
});

//select2
// $('.course__select').select2();
// $('.university__select').select2();
// $('.bachelor__course__select').select2();
// $('.masters__course__select').select2();
// $('.masters__course__select').select2();
// $('.country').select2();
// $('.payment_type').select2();
// $('.district').select2();
// $('.payment_option').select2();
// $('.payment_method_item').select2();

$(".select2").select2();

// currency
function currencyChange() {
    var paymentOption = document.getElementById("payment_option");
    var usdTransactionField = document.getElementById("usd_amount");
    var inrTransactionField = document.getElementById("inr_amount");

    if (paymentOption.value === "usd") {
        usdTransactionField.style.display = "block";
        inrTransactionField.style.display = "none";
    } else if (paymentOption.value === "inr") {
        usdTransactionField.style.display = "none";
        inrTransactionField.style.display = "block";
    } else {
        usdTransactionField.style.display = "none";
        inrTransactionField.style.display = "none";
    }
}

// currency usd and indian rupy
// Define the conversion rates

// Function to perform currency conversion
function convertCurrency() {
    // Get the selected currency
    const selectedCurrency = $("#payment_option").val();

    // Get the input amount
    let inputAmount;
    if (selectedCurrency === "usd") {
        inputAmount = parseFloat($("#usd_input").val());
    } else if (selectedCurrency === "inr") {
        inputAmount = parseFloat($("#inr_amount_input").val());
    } else if (selectedCurrency === "canada") {
        inputAmount = parseFloat($("#canada_amount_input").val());
    } else if (selectedCurrency === "euro") {
        inputAmount = parseFloat($("#euro_amount_input").val());
    } else {
        inputAmount = parseFloat($("#taka").val());
    }

    // Check if the input is a valid number
    if (!isNaN(inputAmount)) {
        // Perform the conversion based on the selected currency
        let convertedAmount;
        if (selectedCurrency === "usd") {
            convertedAmount = inputAmount * usdRate;
        } else if (selectedCurrency === "inr") {
            convertedAmount = inputAmount * indianRupyRate;
        } else if (selectedCurrency === "canada") {
            convertedAmount = inputAmount * canadaRate;
        } else if (selectedCurrency === "euro") {
            convertedAmount = inputAmount * euroRate;
        } else {
            convertedAmount = inputAmount;
        }

        // Display the converted amount
        // $("#display_amount").text(`Converted Amount: ${convertedAmount.toFixed(2)} BDT`);
        $("#display_amount").val(` ${convertedAmount.toFixed(2)} BDT`);
    } else {
        // Clear the display if the input is not a valid number
        $("#display_amount").val("");
    }
}

// Listen for changes in the currency select field
$("#payment_option").change(function () {
    const selectedCurrency = $(this).val();

    // Show/hide input fields based on the selected currency
    $(
        "#usd_amount, #inr_amount,#canada_amount,#euro_amount, #bdt_amount"
    ).hide();

    $("#" + selectedCurrency + "_amount").show();

    // Update the display
    convertCurrency();
});

// Listen for input changes in the input fields
$(
    "#usd_input, #inr_amount_input,#canada_amount_input,#euro_amount_input, #taka"
).on("input", function () {
    convertCurrency();
});

// payment method

function najmul() {
    var paymentMethodSelect = document.getElementById("payment_method_item");
    var txtNumberDiv = document.getElementById("txt_number_div");
    var bankNameDiv = document.getElementById("bank_name_div");
    var bankTxtUploadDiv = document.getElementById("bank_txt_upload_div");

    if (
        paymentMethodSelect.value === "bkash" ||
        paymentMethodSelect.value === "nagod" ||
        paymentMethodSelect.value === "dbbl"
    ) {
        txtNumberDiv.style.display = "block";
        bankNameDiv.style.display = "none";
        bankTxtUploadDiv.style.display = "none";
    } else if (paymentMethodSelect.value === "bank") {
        txtNumberDiv.style.display = "none";
        bankNameDiv.style.display = "block";
        bankTxtUploadDiv.style.display = "block";
    } else {
        txtNumberDiv.style.display = "none";
        bankNameDiv.style.display = "none";
        bankTxtUploadDiv.style.display = "none";
    }
}
