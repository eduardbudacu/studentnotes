import React from 'react';
import {useForm} from 'react-hook-form';

export default function Login() {
    const {
        register,
        handleSubmit,
        formState: {errors},
        reset
    } = useForm();
    const onSubmit = async (data) => {
        let response = await fetch('/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        if(response.status == '200') {
            console.log(await response.json());
        } else {
            alert('Invalid credentials');
            reset();
        }
    }

    return (
        <section className="section-input">
            <form onSubmit={handleSubmit(onSubmit)}>
                <h3>Log in</h3>

                <div className="form-group">
                    <label>Email</label>

                    <input type="email" {...register('email')} className="form-control" placeholder="Enter email" />
                </div>

                <div className="form-group">
                    <label>Password</label>

                    <input type="password" {...register('password')} className="form-control" placeholder="Enter password" />
                </div>

                <div className="form-group">
                    <input type="submit" className="btn btn-primary" />
                </div>
            </form>
        </section>
    )
}