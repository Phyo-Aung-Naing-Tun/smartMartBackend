<template>
    <div>
        <form action="#" class="space-y-6">
            <m-input
                type="text"
                label="User Name"
                placeholder="eg; Mg Mg ..."
                isRequired
            />
            <m-input
                type="email"
                label="User Email"
                placeholder="eg; example@gmail.com"
                isRequired
            />
            <m-input
                type="text"
                label="User Phone"
                placeholder="eg; 09........"
                isRequired
            />
            <m-input
                type="password"
                label="User Password"
                placeholder="Password must be at least 6 characters"
                :minLength="6"
                isRequired
            />
            <m-input
                type="text"
                label="User Address"
                placeholder="eg; no(),street,region,township,city"
                isRequired
            />
            <role-selector/>
        </form>
    </div>
</template>
