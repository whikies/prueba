import Swal from 'sweetalert2';
import apiApp from '../react/api/apiApp';
import '../scss/form_js.scss';

declare var window:any;

document.addEventListener('DOMContentLoaded', () => {
    let form = document.getElementById(window.APP_REACT_VARS.formId);
    let resultWrap = document.getElementById('result');
    let loader = document.getElementById('loader');
    let select = form?.querySelector('select.select-operation');
    let operatorA = form?.querySelector('input.input-operator-a');
    let operatorB = form?.querySelector('input.input-operator-b');

    select?.addEventListener('change', (e) => {
        if (['squareRoot', 'cubeRoot'].includes((e.target as HTMLSelectElement)?.value) === true) {
            operatorB?.closest('div')?.style.setProperty('display', 'none');
        } else {
            operatorB?.closest('div')?.style.setProperty('display', 'block');
        }
    })

    form?.addEventListener('submit', async (e) => {
        e.preventDefault();
        loader?.style.setProperty('display', 'flex');

        try {
            const response = await apiApp.get<{result: number;}>(`/${(select as HTMLSelectElement)?.value}/${(operatorA as HTMLInputElement)?.value}/${(operatorB as HTMLInputElement)?.value}`);
            resultWrap?.style.setProperty('display', 'block');
            let span = resultWrap?.querySelector('span:last-child');

            if (span) {
                span.innerHTML = `${response.data.result}`;
            }
        } catch (err: any) {
            if (err?.response?.data?.errorDescription) {
                Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: err.response.data.errorDescription,
                })
            }
        }
        loader?.style.setProperty('display', 'none');
    });
}, false);
