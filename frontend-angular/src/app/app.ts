import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { UserListComponent } from './components/user-list/user-list'; // ton composant

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [CommonModule, UserListComponent],
  template: `<router-outlet></router-outlet>`,
})
export class AppComponent {}
