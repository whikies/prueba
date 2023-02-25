import { useState, useRef, useEffect, FormEvent } from 'react';
import { useForm } from 'react-hook-form';
import { toast } from 'react-toastify';
import { FormFields, ResponseOperation } from './types';
import apiApp from '../../api/apiApp';

declare var window: any;

const useMathOperations = () => {
    const mountedRef = useRef(true);
    const [loader, setLoader] = useState(false);
    const [data, setData] = useState<number|undefined>();
    const { register, handleSubmit, reset, watch, formState:{ errors } } = useForm<FormFields>();

    useEffect(() => {
        mountedRef.current = true;
        return () => {
            mountedRef.current = false;
        }
    }, []);

    const submit = (event: FormEvent) => {
        setData(undefined);
        return handleSubmit(handleForm, (errors) => {
            toast.error('Hay errores en el formulario');
        })(event);
    }

    const handleForm = async (data: FormFields) => {
        try {
            setLoader(true);
            const response = await apiApp.get<ResponseOperation>(`/${data.operation}/${data.operatorA}/${data.operatorB}`);
            mountedRef.current && setData(response.data.result);
            mountedRef.current && resetForm();
        } catch (err: any) {
            console.log(err.response);
            if (err?.response?.data?.errorDescription) {
                toast.error(err.response.data.errorDescription);
            }
        }

        mountedRef.current && setLoader(false);
    }

    const resetForm = () => {
        reset({
            operation: undefined,
            operatorA: undefined,
            operatorB: undefined,
        });
    }

    return {
        data,
        loader,
        errors,
        register,
        submit,
        watch
    }
}

export default useMathOperations;
