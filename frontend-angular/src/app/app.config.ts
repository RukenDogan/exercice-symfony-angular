import { ApplicationConfig } from '@angular/core';
import { provideRouter } from '@angular/router';
import { provideHttpClient } from '@angular/common/http';
import { UserListComponent } from './components/user-list/user-list';

export const appConfig: ApplicationConfig = {
  providers: [
    provideHttpClient(),
    provideRouter([
      { path: '', redirectTo: '/users', pathMatch: 'full' },
      { path: 'users', component: UserListComponent }
    ])
  ]
};
