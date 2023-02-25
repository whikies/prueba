export type Operation = 'add' | 'subtract' | 'multiply' | 'division' | 'percentage' | 'squareRoot' | 'cubeRoot' | 'exponencial';

export type Operations = {
    label: string;
    value: Operation;
}

export type FormFields = {
    operation: Operation;
    operatorA: number;
    operatorB?: number;
}

export type ResponseOperation = {
    result: number;
}
