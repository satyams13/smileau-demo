$(document).ready(function() {
    // regiaterFormValidator();

    // Create a Stripe client.
    var stripe = Stripe('pk_test_51Hm2L0AWdC2MCjw58yHGUz4ejb5KPJCCzE2iVeCaq1heKee7vPufDdIMgiOFRmS2lQcKrtz9kW69boQNS5YNzakp00HzSZLw18');

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', async (e) => {
        e.preventDefault();

        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value }
                }
            }
        );

        if (error) {

        } else {
            var form = document.getElementById('registerForm');
            var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'payment_method');
                hiddenInput.setAttribute('value', setupIntent.payment_method);
                form.appendChild(hiddenInput);
                // Submit the form
                form.submit();
        }
    });
});


function regiaterFormValidator () {
    $('#registerForm').bootstrapValidator({
        live: 'enabled',
        submitButtons: 'button[type="submit"]',
        fields: {
            name: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The username is required and cannot be empty'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required and cannot be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    },
                    identical: {
                        field: 'password_confirmation',
                        message: 'The password and its confirm are not the same'
                    },
                    stringLength: {
                        min: 8,
                        message: 'The password must be 8 characters long'
                    },
                }
            },
            password_confirmation: {
                validators: {
                    notEmpty: {
                        message: 'The password confirmation is required and cannot be empty'
                    },
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    },
                    stringLength: {
                        min: 8,
                        message: 'The password confirmation must be 8 characters long'
                    },
                }
            }
        }
    });
}
