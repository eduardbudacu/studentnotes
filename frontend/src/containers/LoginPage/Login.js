import React from 'react';
import {useForm} from 'react-hook-form';
import { useNavigate } from "react-router-dom";

export default function Login() {
    const navigate = useNavigate();

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
            let authData = await response.json();
            localStorage.setItem('jwt_token', JSON.stringify(authData.token));
            console.log('auth success');
            navigate('/');
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

                <div className="form-group" style={{marginTop: "10px", textAlign:"right"}}>
                    <input type="submit" className="btn btn-primary" />
                </div>
            </form>
        </section>
    )
}