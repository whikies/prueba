import React from 'react';
import FormGroup from '../Form/FormGroup';
import Label from '../Form/Label';
import Select from '../Form/Select';
import Input from '../Form/Input';
import Button from '../Button';
import { operations } from './data';
import useMathOperations from './useMathOperations';
import Loader from '../Loader/index';
// @ts-ignore
import styleForm from '../Form/Form.module.scss';
// @ts-ignore
import styles from './MathOperations.module.scss';

const MathOperations = () => {
    const { data, loader, errors, register, submit, watch } = useMathOperations();

    return (
        <>
            <div className={ styles.main }>
                <form onSubmit={ submit }>
                    <FormGroup>
                        <Label>Operación</Label>
                        <Select
                            {...register(`operation`, {
                                required: true,
                            }) } className={ errors?.operation ? styleForm.isInvalid : '' }
                        >
                            <option value="">Selecciona una operación</option>
                            { operations.map(operation => (
                                <option value={ operation.value }>{ operation.label }</option>
                            )) }
                        </Select>
                    </FormGroup>
                    <FormGroup>
                        <Label>Operador A</Label>
                        <Input
                            type="number"
                            step={ 0.1 }
                            {...register(`operatorA`, {
                                required: true,
                            }) } className={ errors?.operatorA ? styleForm.isInvalid : '' }
                            autoComplete="off"
                            autoCapitalize="off"
                            autoCorrect="off"
                        />
                    </FormGroup>
                    {
                        ['squareRoot', 'cubeRoot'].includes(watch('operation')) === false && (
                            <FormGroup>
                                <Label>Operador B</Label>
                                <Input
                                    type="number"
                                    step={ 0.1 }
                                    {...register(`operatorB`, {
                                        required: true,
                                    }) } className={ errors?.operatorB ? styleForm.isInvalid : '' }
                                    autoComplete="off"
                                    autoCapitalize="off"
                                    autoCorrect="off"
                                />
                            </FormGroup>
                        )
                    }
                    <Button type="submit" typeBtn="success">Calcular</Button>
                </form>
            </div>
            {
                data && (
                    <div className={ [styles.main, styles.result].join(' ') }>
                        <span>Resultado:</span>
                        <span>{ data }</span>
                    </div>
                )
            }
            { loader && <Loader absolute size={ 40 } color='#444444' /> }
        </>
    )
}

export default MathOperations;
