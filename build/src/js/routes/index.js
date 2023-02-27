import { Home } from '@gigz/pages/home';

export function Routes(page) {
    switch (page) {
        case 'home':
            Home();
            break;
    }
}